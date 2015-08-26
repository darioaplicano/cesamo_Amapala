
<div class="modal fade" id="viewMore" tabindex="-1" role="dialog"
    aria-labelledby="Modallabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title">Información de usuario</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer right">
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">
                            Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addEmployed" tabindex="-1" role="dialog"
    aria-labelledby="Modallabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title">Agregar empleado</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer right">
                <button type="button" class="btn_update btn btn-success"
                    data-dismiss="modal">
                            Agregar
                </button>
                <button type="button" class="btn btn-danger"
                    data-dismiss="modal">
                            Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".btn_view").click(function(event){
            event.preventDefault();
            id = $(this).data('id');
            $.get('pages-modules/humanResources/viewMore.php?codE=' + id, function(html){
                $('#viewMore .modal-body').html(html);
            });
        });
        
        $(".btn_addEmployed").click(function(event){
            event.preventDefault();
            id = $(this).data('id');
            $.get('pages-modules/humanResources/addEmployeds.php', function(html){
                $('#addEmployed .modal-body').html(html);
            });
        });
    });
</script>