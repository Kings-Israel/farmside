<section id="footer">
    <div class="container text-center">
        <p>&copy; FARMSIDE MEDIA <?php echo date('Y')?></p>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script src="js/script.js"></script>

  <!-- Menu Toggle Script -->
<script>

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>