<?php include 'Views/template-principal/header.php'; ?>

<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Contact Us</h1>
        <p>
            En el siguiente formulario puedes enviarnos un mensaje,
            nuestra área de atención al cliente te responderá a tu correo 
            en un tiempo adecuado, muchas gracias.
        </p>
    </div>
</div>

<!-- Start Map -->
<div id="mapid" style="width: 100%; height: 300px;"></div>
<!-- Ena Map -->

<!-- Start Contact -->
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" role="form">
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="inputname">Nombre y apellido</label>
                    <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Nombre y apellido">
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="inputemail">Email</label>
                    <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Asunto</label>
                <input type="text" class="form-control mt-1" id="subject" name="subject" placeholder="Asunto">
            </div>
            <div class="mb-3">
                <label for="inputmessage">Mesanje</label>
                <textarea class="form-control mt-1" id="message" name="message" placeholder="Mensaje" rows="8"></textarea>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="button" class="btn btn-success btn-lg px-3">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Contact -->
<!-- Start Footer -->
<?php include 'Views/template-principal/footer.php'; ?>
</body>

</html>