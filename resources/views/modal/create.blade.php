<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create new item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="warningWrapper">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>We've found the following errors!</strong>
                        <p id="createErrors"></p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form id="createForm" action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="old_image" id="old_image" value="">
                    <div class="form-group row">
                        <label for="imageFile" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input class="form-control-file"
                                   id="newImageFile"
                                   type="file"
                                   name="imageFile"
                                   onchange="readURL(this, 'newImage');"
                                   accept="image/gif, image/jpeg, image/png"
                                   style="margin-top: 10px">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="currentImage" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <img src="" alt="" class="image-responsive" id="newImage">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input class="form-control description" id="new-description" type="text" name="description" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitEdit" onclick="createItem(this)">Submit</button>
            </div>
        </div>
    </div>
</div>
