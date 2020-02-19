<template>
    <div class="card mt-5 p-5">
        <div v-if="auth" class="form-inline my-4 w-full">
            <input
                v-model="newComment"
                type="text"
                class="form-control form-control-sm w-80"
            />
            <button
                @click="addComment"
                type="button"
                class="btn btn-sm btn-primary"
            >
                <small>Add comment</small>
            </button>
        </div>

        <comment
            v-for="comment in comments.data"
            :key="comment.id"
            :comment="comment"
            :video="video"
        ></comment>

        <div class="text-center mt-4">
            <button
                class="btn btn-success"
                @click="fetchComments"
                v-if="comments.next_page_url"
            >
                Load more
            </button>
            <span v-else>No more comments to show</span>
        </div>
    </div>
</template>

<script>
import Comment from "./comment";

export default {
    props: ["video"],
    components: {
        Comment
    },
    mounted() {
        this.fetchComments();
    },

    computed: {
        auth() {
            return __auth();
        }
    },

    data: () => ({
        comments: {
            data: []
        },
        newComment: ""
    }),

    methods: {
        fetchComments() {
            const url = this.comments.next_page_url
                ? this.comments.next_page_url
                : `/videos/${this.video.id}/comments`;

            axios.get(url).then(({ data }) => {
                this.comments = {
                    ...data,
                    data: [...this.comments.data, ...data.data]
                };
            });
        },

        addComment() {
            if (!this.newComment) return;

            axios
                .post(`/comments/${this.video.id}`, {
                    body: this.newComment
                })
                .then(({ data }) => {
                    this.comments = {
                        ...this.comments,
                        data: [data, ...this.comments.data]
                    };
                });
        }
    }
};
</script>
