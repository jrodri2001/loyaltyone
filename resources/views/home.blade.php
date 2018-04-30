@extends('layouts.base')

@section('title', 'Home')

@section('content')

    <div class="container mb-2">
        <div class="row">
            <div class="col-sm">
                <form id="myform" action="" method="post">
                    <div class="form-group">
                        <label for="username">User</label>
                        <input type="username" class="form-control" id="username" name="username"
                               aria-describedby="textHelp"
                               placeholder="Enter Your Username" required>
                        <small id="textHelp" class="form-text text-muted">Username</small>
                    </div>

                    <div class="form-group">
                        <label for="text">Text to send</label>
                        <input type="text" class="form-control" id="text" name="text" aria-describedby="textHelp"
                               placeholder="Enter Text" required>
                        <small id="textHelp" class="form-text text-muted">Text to send.</small>
                    </div>

                    <div class="form-group">
                        <label for="response"> Response: </label>
                        <div id="response" name="response"></div>
                    </div>

                    <input class="btn btn-primary" id="button" type="submit" value="Done">
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div id="userSubmissions"></div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    {{--Include submission template for handlebars--}}
    @include('submission');
    @include('replyform');

    <script language="JavaScript">
        var submission = $("#submission-template").html();
        var replyform = $("#replyform-template").html();
        var templateSubmission = Handlebars.compile(submission);
        var templateReplyForm = Handlebars.compile(replyform);

        function renderSubmission(data, indent) {
            var html = templateSubmission({
                'user': data.username,
                'text': data.text,
                'id': data.id,
                'indent': indent
            });
            $('#userSubmissions').append(html);

            if (data.all_replies.length > 0) {
                console.log('submission ' + data.id + ' has replies');
                for (var i = 0; i < data.all_replies.length; i++) {
                    var current = data.all_replies[i];
                    renderSubmission(current, indent + 1);
                }
            }
        }

        function updateSubmissions() {
            var max_indent_level = 5;
            //call api and get all submissions, then display them using template

            $('#userSubmissions').empty();

            $.ajax({
                url: "/api/submission",
                method: "GET",
                dataType: "json",
                context: document.body
            }).done(function (data) {
                var current_level = 0;
                for (var i = 0; i < data.length; i++) {
                    var current = data[i];
                    renderSubmission(current, 0);
                }


            }).fail(function (data) {
                $('#response').html("something went wrong");
            }).always(function () {

                //when Reply is clicked, show form below element
                $('.reply').click(function (e) {
                    //close any open reply-forms
                    $('.reply-form').remove();

                    console.log('reply button clicked');
                    e.preventDefault();

                    //render a new form, and slide it below
                    var html = templateReplyForm({
                        'id': $(this).data('id'),
                        'indent': $(this).data('indent')
                    });

                    $(this).closest('.card').after(html);

                    //submit reply
                    $("#submitReply").click(function (e) {
                        var form = $(this).closest('form');
                        e.preventDefault();


                        console.log("submitting reply form");
                        $.ajax({
                            url: "/api/submission/reply/" + $(this).data('id'),
                            method: "POST",
                            data: $(form).serialize(),
                            dataType: "json",
                            context: document.body
                        }).done(function (data) {
                            if (data.status === "ok") {
                                $('#response').html("Reply Received");

                                //insert all the submissions by the user
                                updateSubmissions();
                            } else {
                                console.log(data);
                                $('#response').html(data.status, data.message);
                            }

                        }).fail(function (data) {
                            $('#response').html("something went wrong");
                        });
                        event.preventDefault();

                    });
                });
            });


        }

        $(document).ready(function () {
            //Update submissions,
            updateSubmissions();

            //Lets validate the form
            $('#myform').validate(
                {
                    rules: {
                        text: "required",
                        username: "required"
                    },
                    messages: {
                        text: "Please include a text to send",
                        username: "Please include your username"
                    },
                    submitHandler: function (form) {
                        //Just send an ajax request with the text on the Text input, and record response or fail into response div
                        $.ajax({
                            url: "/api/submission",
                            method: "POST",
                            data: {
                                text: $('#text').val(),
                                username: $('#username').val()
                            },
                            dataType: "json",
                            context: document.body
                        }).done(function (data) {
                            if (data.status === "ok") {
                                $('#response').html("Submission saved");

                                //insert all the submissions by the user
                                updateSubmissions();
                            } else {
                                console.log(data);
                                $('#response').html(data.status, data.message);
                            }

                        }).fail(function (data) {
                            $('#response').html("something went wrong");
                        });
                    }
                }
            );

        });

    </script>


@endsection