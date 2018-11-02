<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
include './util/mask.php';
include './config/crud.php';
include './controle/empresaControle.php';

$sql = new EmpresaControle();
$obj = json_decode($sql->buscarTodasEmpresa());
?>
<!-- page content -->
<div class="right_col" role="main">    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <button type="button" id="novo-cad" class="btn btn-success">Adicionar Empresa</button>
                    <input type="hidden" value="cad_empresa" id="area" />
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-bordered table-striped jambo_table bulk_action">
                        <thead>
                            <tr>
                                <th>Razão</th>
                                <th>Cnpj</th>
                                <th>Telefone</th>
                                <th>Situação</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($obj as $registro):
                                ?>
                                <tr>
                                    <td style="display: none;" class="id"><?= base64_encode($registro->id) ?></td>
                                    <td><?= $registro->razao ?></td>
                                    <td><?= Mascara::mask($registro->cnpj,'##.###.###/####-##') ?></td>
                                    <td><?= $registro->telefone ?></td>
                                    <td><?= ($registro->status ? 'Ativo' : 'Inativo') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--/page content -->
