@extends('layouts.base')

@section('title', 'Home')

@section('content')
    <h1>Hello World</h1>

    <form id="myform" action="">
        <div class="form-group">
            <label for="text">Text to send</label>
            <input type="text" class="form-control" id="text" name="text" aria-describedby="textHelp" placeholder="Enter Text">
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
//            When done button is pressed, send Ajax request and receive response into result div
            $('#button').click(function (e) {
                e.preventDefault();
                console.log("Done button clicked");

//                Just send an ajax request with the text on the Text input, and record response or fail into response div
                $.ajax({
                    url: "/api/" + $('#text').val(),
                    context: document.body
                }).done(function (data) {
                    $('#response').html(data);
                    $('#response').html(data);
                }).fail(function (data) {
                    $('#response').html("something went wrong");
                });

            });
        });

    </script>
@endsection