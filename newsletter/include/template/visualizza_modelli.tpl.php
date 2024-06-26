<? include_module('header.inc.php'); ?>

<? include_module('navbar.inc.php'); ?>

<? include_module('sidebar.inc.php'); ?>


<div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                <? include_module('breadcrumb.inc.php'); ?>
                                    <div class="page-body">
                                    <div class="card">
                                                <div class="card-block">
                                                              <div class="row">
                                                                <?php include(BASE_PATH_SITO.'newsletter/include/template/moduli/menu.inc.php');?>
                                                                  <div class="col-md-10">
                                                                  <h2>VISUALIZZA MODELLI <?=NOME_CLIENT_EMAIL?></h2>
                                                                  <table id="TabellaLayout" class="xcrud-list table table-striped table-hover table-bordered table-sm">
                                                                      <thead>
                                                                          <tr class="xcrud-th">
                                                                              <th class="th-sm" style="width:50%">Nome Modello</th>
                                                                              <th class="th-sm text-center" style="width:5%">Lingua</th>
                                                                              <th class="th-sm text-center" style="width:5%">Preview</th>
                                                                              <th class="th-sm text-center" style="width:5%">Modifica</th>
                                                                              <th class="th-sm text-center" style="width:5%">Elimina</th>
                                                                          </tr>
                                                                      </thead>
                                                                      <?php echo $content; ?>
                                                                  </table>
                                                                  <script>
                                                                        $(document).ready(function () {

                                                                            $('#TabellaLayout').DataTable({
                                                                                    "paging": true,
                                                                                    "pagingType": "simple_numbers",    
                                                                                    "language": {
                                                                                        "search": "Filtra i risultati:",
                                                                                        "info": "Visualizza pagina _PAGE_ di _PAGES_ per _TOTAL_ righe",
                                                                                        "paginate": {
                                                                                            "previous": "Precedente",
                                                                                            "next":"Successivo",
                                                                                        },
                                                                                        buttons: {
                                                                                            pageLength: {
                                                                                                _: "Mostra %d elementi",
                                                                                                '-1': "Mostra tutto"
                                                                                            }
                                                                                        }
                                                                                    },
                                                                                    dom: 'Bfrtip',
                                                                                    lengthMenu: [
                                                                                        [ 10, 25, 50, -1 ],
                                                                                        [ '10 risultati', '25 risultati', '50 risultati', 'Tutti' ]
                                                                                    ],						
                                                                                    buttons: [ 'pageLength', ],
                                                                                });
                                                                                $('#TabellaLayout').DataTable().order([0,'desc']).draw();
                                                                                $('.dataTables_length').addClass('bs-select');

                                                                            });
                                                                    </script>
                                                                 
                                                                  </div>
                                                              </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    <!-- /.content -->
    <? include_module('footer.inc.php'); ?>