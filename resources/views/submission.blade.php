<script id="submission-template" type="text/x-handlebars-template">
    <div class="card ml-@{{ indent }}">
        <div class="card-body">
            <p class="card-text">
            User: @{{ user }} Text: @{{ text }}
            </p>

            <a href="#" data-id="@{{ id }}" data-indent="@{{ indent }}" class="btn btn-primary reply">Reply</a>
        </div>
    </div>
</script>