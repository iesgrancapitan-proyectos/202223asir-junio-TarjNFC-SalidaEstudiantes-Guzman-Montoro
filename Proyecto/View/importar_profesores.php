<div id='divcentral' class='container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center'>
    <div class='d-flex justify-content-center'>
        <div id='divcentral2' class='text-center'>
            <form action='index.php?controller=usuario&action=importarProfesores' method='post' enctype='multipart/form-data' id='import_form'>
                
                <input type='file' name='file' />
                <input type='submit' class='btn btn-primary' name='enviar' value='Cargar datos'>
                <a class='btn btn-primary' href='javascript:history.go(-1)'>Volver</a>

            </form>
        </div>
    </div>
</div>