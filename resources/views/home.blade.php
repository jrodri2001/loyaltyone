@extends('layouts.base')

@section('title', 'Home')

@section('content')
    <h1>Hello World</h1>

    <form id="myform" action="">
        <div class="form-group">
            <label for="text">Text to send</label>
            <input type="text" class="form-control" id="text" name="text" aria-describedby="textHelp" placeholder="Enter Text" required>
            <small id="textHelp" class="form-text text-muted">Text to send.</small>
        </div>

        <div class="form-group">
            <label for="response"> Response: </label>
            <div id="response" name="response"></div>
        </div>

        <input id="button" type="submit" value="Done">
    </form>
@endsection

@section('scripts')
    <script language="JavaScript">
        $(document).ready(function () {
            //Lets validate the form
            $('#myform').validate(
                {
                    rules: {
                        text: "required",
                    },
                    messages:{
                        text: "Please include a text to send"
                    },
                    submitHandler: function(form) {
                        console.log("Done button clicked");
                        //Just send an ajax request with the text on the Text input, and record response or fail into response div
                        $.ajax({
                            url: "/api/submission",
                            method: "POST",
                            data: {
                                text: $('#text').val()
                            },
                            dataType: "json",
                            context: document.body
                        }).done(function (data) {
                            if (data.status === "ok"){
                                $('#response').html("Submission saved");
                            }else{
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