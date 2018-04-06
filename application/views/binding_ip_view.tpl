<div class="col-md-12">
    <div class="panel panel-info" id="grid_block_1">
        <div class="panel-heading">
            <h3 class="panel-title">{BINDINGIPADRESS}</h3>
        </div>
        <div class="form-group">
            <div id="result"></div>
        </div>
        <div class="panel-body">
            <p>
                {UPDATESECURITYIP}
            </p>

            <form action="#" method="post" id="bingind">
                <input type="hidden" name="CSRF" id="CSRF" value="<?php echo $data['csrfToken']; ?>">
                <input type="submit" class="btn btn-info" name="bingind" value="{BIND}">
            </form>
            <hr>
            <p> {BINDRECOMMEND}
                <br> {IFDYNAMICIP}
                <br>
            </p>
        </div>
    </div>
</div>
<script type="text/javascript">
    function success(result) {
        $('#result').html(result);
    }

    function beforeSend() {
        $('#result').html('<img id="imgcode" src="/default.gif">');
    }

    function errors() {
        $('#result').html('{ERRORAGAINLATER}');
    }

    $(function () {
        $("#bingind").submit(function () {
            var formData = {
                "CSRF": $("#CSRF").val()
            };
            $.ajax({
                url: '/ajax/binding_ip/'
                , type: 'POST'
                , data: 'jsonData=' + toJSON(formData)
                , error: errors
                , success: success
                , beforeSend: beforeSend
            });
            return false;
        });
    });
</script>