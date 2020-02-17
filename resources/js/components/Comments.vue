<template>
    <div class="card mt-5 p-5">
        <div class="media" v-for="comment in comments.data">
            <avatar
                :username="comment.user.name"
                :size="30"
                class="mr-3"
            ></avatar>
            <div class="media-body">
                <h6 class="mt-0">
                    {{ comment.user.name }}
                </h6>
                <small>{{ comment.body }}</small>
                <div class="form-inline my-4 w-full">
                    <input
                        type="text"
                        class="form-control form-control-sm w-80"
                    />
                    <button type="button" class="btn btn-sm btn-primary">
                        <small>Add comment</small>
                    </button>
                </div>

                <div class="media mt-3">
                    <a href="#" class="mr-3">
                        <img
                            src="https://picsum.photos/id/42/200/200"
                            width="30"
                            height="30"
                            class="rounded-circle mr-3"
                        />
                    </a>
                    <div class="media-body">
                        <h6 class="mt-0">Media heading</h6>
                        <small
                            >Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Perferendis, eligendi?</small
                        >
                        <div class="form-inline my-4 w-full">
                            <input
                                type="text"
                                class="form-control form-control-sm w-80"
                            />
                            <button
                                type="button"
                                class="btn btn-sm btn-primary"
                            >
                                <small>Add comment</small>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-success">
                Load more
            </button>
        </div>
    </div>
</template>
<script>
import Avatar from "vue-avatar";
export default {
    props: ["video"],
    components: {
        Avatar
    },
    mounted() {
        this.fetchComments();
    },

    data: () => ({
        comments: {
            data: []
        }
    }),

    methods: {
        fetchComments() {
            axios.get(`/videos/${this.video.id}/comments`).then(({ data }) => {
                this.comments = data;
            });
        }
    }
};
</script>
