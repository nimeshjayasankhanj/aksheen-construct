<div class="modal fade" id="editBrandModal" tabindex="-1"
     role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Brand</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
            </div>
            <div class="modal-body">
                <form class="" method="post" enctype="multipart/form-data"
                action="{{ route('editBrand') }}" id="editBrandId">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Brand<span style="color: red"> *</span></label>

                    <input type="text" class="form-control" name="uBrand" id="uBrand" autocomplete="off"
                           placeholder="Brand"/>
                    <span class="text-danger" id="uCategryError"></small>
                </div>
                <input type="hidden" id="hiddenID" name="hiddenID" />
                <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="editBrand"
                        style="border-radius: 24px">
                    Edit Brand</button>

                    <button type="submit" class="btn btn-md btn-outline-primary waves-effect" id="uWaitButton"
                    style="border-radius: 24px;display: none">
                    <i class="fa fa-circle-o-notch fa-spin"></i> Plsease Wait</button>

                </form>
            </div>
        </div>
    </div>
</div>



