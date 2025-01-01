<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../HRM/src/assets/css/styles.min.css">
</head>
<body>
<div class="row">
    <!-- Import link -->

    <a href="javascript:void(0);" class="btn btn-info text-light ms-6" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
    <div class="col">
        </div>
    </div>
    <div class="form-actions">
        <div class="card-body border-top">
            <div class="col" id="importFrm" style="display: none;">
                <form action="importData.php" method="post" enctype="multipart/form-data">
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="file" class="form-control mt-3" name="file">                              
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <input type="submit" class="btn btn-info text-light ms-6" name="importSubmit" value="Import CSV">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
</body>
</html>

