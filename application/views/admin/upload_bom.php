<?php include('header.php'); ?>

<style>

    .main-content {

        display: flex;

        justify-content: center;

        align-items: center;

        min-height: 85vh;

        background-color: #f4f8fb;

    }



    .upload-container {

        background: #fff;

        padding: 40px;

        border-radius: 15px;

        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);

        width: 100%;

        max-width: 700px;

    }



    .upload-box {

        border: 2px dashed #ccc;

        border-radius: 10px;

        padding: 30px;

        text-align: center;

        transition: 0.3s;

        background-color: #f9f9f9;

        cursor: pointer;

        display: flex;

        align-items: center;

        justify-content: center;

        width: 610px;

    }



    .upload-box:hover {

        border-color: #007bff;

        background-color: #eef7ff;

    }



    .upload-icon {

        font-size: 30px;

        color: #0d6efd;

        margin-right: 15px;

    }



    .file-label {

        font-weight: 500;

        color: #333;

    }



    input[type="file"] {

        display: none;

    }



    .submit-btn {

        margin-top: 20px;

        width: 100%;



        background-color: #212529;

    }

</style>



<div class="main-content">

    <div class="upload-container">

        <div class="text-center mb-4">

            <h2 class="page-title" style="display:block">Upload BOM Report</h2>

        </div>

        <form method="post" enctype="multipart/form-data" class="row g-4">

            <div class="col-12">

                <label for="upload1" class="upload-label">

                    <div class="upload-box">

                        <div class="upload-icon">

                            <i class="bi bi-upload"></i>

                        </div>

                        <div>

                            <div class="file-label">Upload BOM Report</div>

                            <div id="fileName1" name="" class="text-muted small">No file chosen</div>

                        </div>

                    </div>

                </label>

                <input type="file" id="upload1" name="fileName1" onchange="showFileName(this, 'fileName1')">

            </div>

            <div class="col-12">

                <button id="submit" type="submit" name="upload_file" value="upload_file" class="btn btn-dark  btn-dark  submit-btn">

                    Submit

                </button>

            </div>

        </form>

    </div>

</div>



<?php include('footer.php'); ?>



<script>

    function showFileName(input, targetId) {

        const fileName = input.files.length > 0 ? input.files[0].name : "No file chosen";

        document.getElementById(targetId).textContent = fileName;

    }



  

</script>

   <script>
    $(document).ready(function() {
        $('#bom-master .nav-link').addClass('nav_active');
        $('#bom-master .child_menu').addClass('show');
         $('#upload-bom').addClass('active_cc');

    });
  
    </script>