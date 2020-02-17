<template>
    <div>
        <svg
            @click="vote('up')"
            class="thumbs-up"
            :class="{ 'thumbs-up-active': upVoted }"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            version="1.1"
            width="24"
            height="24"
            viewBox="0 0 24 24"
        >
            <path
                d="M5,9V21H1V9H5M9,21A2,2 0 0,1 7,19V9C7,8.45 7.22,7.95 7.59,7.59L14.17,1L15.23,2.06C15.5,2.33 15.67,2.7 15.67,3.11L15.64,3.43L14.69,8H21C22.11,8 23,8.9 23,10V12C23,12.26 22.95,12.5 22.86,12.73L19.84,19.78C19.54,20.5 18.83,21 18,21H9M9,19H18.03L21,12V10H12.21L13.34,4.68L9,9.03V19Z"
            />
        </svg>
        {{ upvotes_count }}
        <svg
            @click="vote('down')"
            class="thumbs-down"
            :class="{ 'thumbs-down-active': downVoted }"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            version="1.1"
            width="24"
            height="24"
            viewBox="0 0 24 24"
        >
            <path
                d="M19,15V3H23V15H19M15,3A2,2 0 0,1 17,5V15C17,15.55 16.78,16.05 16.41,16.41L9.83,23L8.77,21.94C8.5,21.67 8.33,21.3 8.33,20.88L8.36,20.57L9.31,16H3C1.89,16 1,15.1 1,14V12C1,11.74 1.05,11.5 1.14,11.27L4.16,4.22C4.46,3.5 5.17,3 6,3H15M15,5H5.97L3,12V14H11.78L10.65,19.32L15,14.97V5Z"
            />
        </svg>
        {{ downvotes_count }}
    </div>
</template>
<script>
import numeral from "numeral";

export default {
    props: {
        default_votes: {
            required: true,
            default: () => []
        },
        entity_owner: {
            required: true,
            default: ""
        },
        entity_id: {
            required: true,
            default: ""
        }
    },

    data() {
        return {
            votes: this.default_votes
        };
    },

    computed: {
        upVotes() {
            return this.votes.filter(v => v.type === "up");
        },

        downVotes() {
            return this.votes.filter(v => v.type === "down");
        },

        upvotes_count() {
            return numeral(this.upVotes.length).format("0a");
        },

        downvotes_count() {
            return numeral(this.downVotes.length).format("0a");
        },

        upVoted() {
            if (!__auth()) return false;
            return !!this.upVotes.find(v => v.user_id === __auth().id);
        },

        downVoted() {
            if (!__auth()) return false;
            return !!this.downVotes.find(v => v.user_id === __auth().id);
        }
    },
    methods: {
        vote(type) {
            if (!__auth()) {
                return alert("Please login to vote.");
            }

            if (__auth() && __auth().id === this.entity_owner) {
                return alert("you cant vote your own video");
            }

            if (type === "up" && this.upVoted) return;
            if (type === "down" && this.downVoted) return;

            axios.post(`/votes/${this.entity_id}/${type}`).then(({ data }) => {
                if (this.upVoted || this.downVoted) {
                    this.votes = this.votes.map(v => {
                        if (v.user_id === __auth().id) {
                            return data;
                        }
                        return v;
                    });
                } else {
                    this.votes = [...this.votes, data];
                }
            });
        }
    }
};
</script>
