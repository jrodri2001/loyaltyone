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

    <script id="submission-template" type="text/x-handlebars-template">
        <div class="card">
            <div class="card-body">
                @{{ text }}
            </div>
        </div>
    </script>

    <script language="JavaScript">
        var source   = $("#submission-template").html();
        var templateScript = Handlebars.compile(source);

        function updateSubmissions(data) {

            $('#userSubmissions').empty();
            for (var i = 0; i < data.length; i++) {
//                $('#userSubmissions').append('<div class="card"><div class="card-body">' + data[i].text + '</div></div>');
                var html = templateScript({'text': data[i].text});
                $('#userSubmissions').append(html);
            }
        }

        $(document).ready(function () {
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
                                updateSubmissions(data.data);
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