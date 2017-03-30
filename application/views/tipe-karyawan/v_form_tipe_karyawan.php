<!-- BEGIN FORM-->
    <form action="#" id="formAdd" class="form-horizontal" method="post">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
            <input type="hidden" id="url" value="Master-Data/Tipe-Karyawan/postData/">
            <div class="form-group" hidden="true">
                <label class="control-label col-md-4">Kode Tipe Karyawan (Auto)
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="kode" readonly /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Tipe Karyawan
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="type_karyawan_nama" required /> </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-4">Status Tipe Karyawan
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control select2" name="type_karyawan_status_aktif" aria-required="true" aria-describedby="select-error" required>
                            <option id="aktif" value="y"> Aktif </option>
                            <option id="nonaktif" value="n"> Non Aktif </option>
                        </select>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-4 col-md-8 text-right">
                    <button type="submit" class="btn green-jungle">Submit</button>
                    <button type="button" class="btn default reset" onclick="reset()">Reset</button>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
    <script type="text/javascript">
        $(document).ready(function(){
        });
    </script>