<div class="modal fade" id="FormModal" data-backdrop="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $page_title;?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="FormModalMd" data-backdrop="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $page_title;?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteModal" data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <h5 class='col-12 modal-title text-center'>Apakah Anda yakin ingin menghapus data ini? ?</h5>
            </div>
            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <a href="#" class="btn btn-danger" id="hard_delete_link">Delete</a>
                <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	function FormModal(url){
		jQuery('#FormModal').modal('show', {backdrop: 'true'});
		$.ajax({
			url: url,
			success: function(response){
				jQuery('#FormModal .modal-body').html(response);
			}
		});
	}
</script>

<script type="text/javascript">
	function FormModalMd(url){
		jQuery('#FormModalMd').modal('show', {backdrop: 'true'});
		$.ajax({
			url: url,
			success: function(response){
				jQuery('#FormModalMd .modal-body').html(response);
			}
		});
	}
</script>

<script type="text/javascript">
    function DeleteModal(delete_url){
        jQuery('#DeleteModal').modal('show', {backdrop: 'static'});
        document.getElementById('hard_delete_link').setAttribute('href' , delete_url);
        document.modal.style.zoom = "80%" 
    }
</script>