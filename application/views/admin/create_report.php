
<?php include('header.php'); ?>
<style>
  .upload-box:hover {
    border-color: #007bff;
    background-color: #eef7ff;
  }

  .upload-icon {
    font-size: 24px;
    color: #6c757d;
  }

  .file-label {
    font-size: 14px;
    color: #555;
  }

  input[type="file"] {
    display: none;
  }

  .upload-label {
    width: 100%;
  }

  .upload-box {
    border: 2px dashed #ccc;
    border-radius: 10px;
    padding: 30px;
    text-align: center;
    transition: border-color 0.3s ease;
    background-color: #f9f9f9;
    cursor: pointer;
   
    display: flex;
    align-items: center;
    justify-content: space-around;
    margin:0px 25px
  }
  .error{
    margin-left: 27px;
    color: #ff0000;
  }
</style>
<div class="main-content">
  <div class="sub-content">
    <div class="page-header">
      <h6 >
        Report
      </h6>
    </div>

    <form method="post" enctype="multipart/form-data" class="row g-4" id="fg_details_form">

      <!-- Upload Row 1 -->
      <div class="row mb-20 mt-5">
        <div class="col-md-4">
          <label for="upload4" class="upload-label">
            <div class="upload-box ">
              <div class="upload-icon">
                <i class="bi bi-upload"></i>
              </div>
              <div>
                <div class="file-label">Upload MTO Order Report</div>
                <div id="fileName4" class="text-muted small">No file chosen</div>
              </div>
            </div>
          </label>
          <input type="file" id="upload4" name="mto_order_report" onchange="showFileName(this, 'fileName4')">
        </div>

        <div class="col-md-4">
          <label for="upload2" class="upload-label">
            <div class="upload-box">
              <div class="upload-icon">
                <i class="bi bi-upload"></i>
              </div>
              <div>
                <div class="file-label">Upload MTS Order Report</div>
                <div id="fileName2" class="text-muted small">No file chosen</div>
              </div>
            </div>
          </label>
          <input type="file" id="upload2" name="order_report" onchange="showFileName(this, 'fileName2')">
        </div>
      </div>

      <!-- Upload Row 2 -->
      <div class="row mb-20">
        <div class="col-md-4">
          <label for="upload3" class="upload-label">
            <div class="upload-box">
              <div class="upload-icon">
                <i class="bi bi-upload"></i>
              </div>
              <div>
                <div class="file-label">Upload Inventory Report</div>
                <div id="fileName3" class="text-muted small">No file chosen</div>
              </div>
            </div>
          </label>
          <input type="file" id="upload3" name="inventory_report" onchange="showFileName(this, 'fileName3')">
        </div>

        <div class="col-md-4">
          <label for="upload1" class="upload-label">
            <div class="upload-box">
              <div class="upload-icon">
                <i class="bi bi-upload"></i>
              </div>
              <div>
                <div class="file-label">Upload Trigger Report</div>
                <div id="fileName1" class="text-muted small">No file chosen</div>
              </div>
            </div>
          </label>
          <input type="file" id="upload1" name="trigger_report" onchange="showFileName(this, 'fileName1')">
        </div>
      </div>

      <!-- Submit Button Row -->
      <div class="row">
        <div class="col-12">
            <div class="form-group ms-4">
                <button id="submit" type="submit" name="upload_report" value="upload_report" class="btn btn-dark btn-sm">Submit</button>
            </div>
        </div>
      </div>
     
    </form>
  </div>
</div>

<?php include('footer.php'); ?>

<script>
  $(document).ready(function() {
    $('#report').addClass('active');
    $('#create-report').addClass('active');
    $(".sidebar-dropdown").slideToggle().toggleClass('act');
  });
</script>

<script>
  function showFileName(input, targetId) {
    const fileName = input.files.length > 0 ? input.files[0].name : "No file chosen";
    document.getElementById(targetId).textContent = fileName;
  }

  $(document).ready(function() {
    // It's good practice to ensure the method is available.
    if ($.validator && !$.validator.methods.require_from_group) {
        $.validator.addMethod("require_from_group", function(value, element, options) {
            var $fields = $(options[1], element.form),
                $fieldsFirst = $fields.eq(0),
                validator = $fieldsFirst.data("valid_req_grp") ? $fieldsFirst.data("valid_req_grp") : $.extend({}, this),
                isValid = $fields.filter(function() {
                    return validator.elementValue(this);
                }).length >= options[0];
            $fieldsFirst.data("valid_req_grp", validator);
            if (!$(element).data("being_validated")) {
                $fields.data("being_validated", true);
                $fields.each(function() {
                    validator.element(this);
                });
                $fields.data("being_validated", false);
            }
            return isValid;
        }, $.validator.format("Please fill out at least {0} of these fields."));
    }

    $("#fg_details_form").validate({
        ignore: [],
        rules: {
            mto_order_report: {
                require_from_group: [1, ".order-group"]
            },
            order_report: {
                require_from_group: [1, ".order-group"]
            },
            inventory_report: {
                required: true
            },
            trigger_report: {
                required: true
            }
        },
        messages: {
            mto_order_report: {
                require_from_group: "Please upload at least one Order Report (MTO or MTS)."
            },
            order_report: {
                require_from_group: "Please upload at least one Order Report (MTO or MTS)."
            },
            inventory_report: {
                required: "Please upload an Inventory Report."
            },
            trigger_report: {
                required: "Please upload a Trigger Report."
            }
        },
        errorPlacement: function(error, element) {
            // Append the error message inside the column container for all fields.
            // This ensures the error appears directly under the corresponding upload box
            // without disturbing the layout.
            error.appendTo(element.closest('.col-md-4'));
        },
        // This groups the messages for the order reports so only one appears
        groups: {
            orderReports: "mto_order_report order_report"
        }
    });

    // Add the class to the inputs for the group validation
    $('#upload4, #upload2').addClass('order-group');

    // Remove error on click for a better user experience
    $('#upload1, #upload2, #upload3, #upload4').click(function() {
       $(this).closest('.col-md-4').find('label.error').remove();
    });
});
</script>

 <script>
    $(document).ready(function() {
        $('#report-management .nav-link').addClass('nav_active');
        $('#report-management .child_menu').addClass('show');
        $('#create-report').addClass('active_cc');

    });
  
    </script>