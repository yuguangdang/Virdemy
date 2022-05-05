<footer>
    <div class="container">
        <div class="row vcenter">
            <div class="col-xs-6">
                <p>&copy; Virdemy-<?php echo date("Y"); ?></p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>

<script>
    $(function() {
     var height = $(window).height() - (70 + $("footer").outerHeight());
     $(".main").css("min-height",height+"px");
});
</script>