<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <p>IMPORT GPS DATA</p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="file">Select excel file to import: </label>
                        <input type="file" class="form-control" name="gps_file">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success importBtn" data-toggle="modal"
                        data-dismiss="modal" data-target="#myModal">Import</button>
            </div>
        </div>
    </div>
</div>