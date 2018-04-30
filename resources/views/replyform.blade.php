<script id="replyform-template" type="text/x-handlebars-template">
    <div id="reply-form" class="card ml-@{{ indent }} reply-form">
        <div class="card-body">
            <form class="form-inline" action="" method="post">
                <label class="sr-only" for="username">User</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="User" required>

                <label class="sr-only" for="text">Username</label>
                <input type="text" class="form-control" name="text" id="text" placeholder="Text" required>

                <a href="#" id="submitReply" data-id="@{{id}}" class="btn btn-primary">Reply</a>
            </form>
        </div>
    </div>
</script>