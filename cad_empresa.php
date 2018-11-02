<?php
if (isset($_GET['id'])) :
    include './config/crud.php';
    include './controle/empresaControle.php';

    $id = base64_decode($_GET['id']);
    $sql = new EmpresaControle();
    $obj = json_decode($sql->buscarEmpresaId($id));
    if (!empty($obj)) :
        foreach ($obj as $registro):
            $razao = $registro->razao;
            $email = $registro->email;
            $cnpj = $registro->cnpj;
            $site = $registro->site;
            $senha = $registro->senha;
            $telefone = $registro->telefone;
            $status = $registro->status;
        endforeach;
    endif;
endif;
?>
<!--page content -->
<div class = "right_col" role = "main">
    <div class = "">
        <div class = "clearfix"></div>

        <div id = "msg-sucess" class = "alert alert-success" role = "alert" style = "text-align: center">
            <strong>Cadastro feito com sucesso!</strong>.
        </div>
        <div id = "msg-error" class = "alert alert-danger" role = "alert" style = "text-align: center">
            <strong>Erro ao cadastrar!</strong>
        </div>

        <div class = "row">
            <div class = "col-md-12 col-sm-12 col-xs-12">
                <div class = "x_panel">
                    <div class = "x_content">
                        <input type = "hidden" id = "area" value = "empresas" />
                        <form class = "form-horizontal form-label-left" id = "formulario" action = "view/empresas/salvar.php" method = "post" enctype = "multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id ?>" />
                            <span class = "section">Cadastro Empresa</span>

                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "name">Razão Social <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" value="<?= $razao ?>" class = "form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="razao" placeholder="Nome Empresa" required = "required" type = "text">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "email">Email <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="email" name="email" value="<?= $email ?>" required="required" placeholder="empresa@empresa.com.br" class= "form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "number">CNPJ <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="cnpj" value="<?= $cnpj ?>" class="form-control" placeholder= "99.999.999/9999-99" required="required" data-inputmask="'mask': '99.999.999/9999-99'">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "website">Website URL <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "url" id = "website" name="site" value="<?= $site ?>" placeholder = "https://www.website.com" class = "form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label for = "password" class = "control-label col-md-3">Password</label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input id = "password" type = "password" name = "senha" value="<?= $senha ?>" data-validate-length = "6,8" class = "form-control col-md-7 col-xs-12" required = "required">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "telephone">Telefone <span class = "required">*</span>
                                </label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <input type = "text" name = "telefone" value="<?= $telefone ?>" class = "form-control" required = "required" placeholder = "(99) 999-9999" data-inputmask = "'mask' : '(99) 9999-9999'">
                                </div>
                            </div>
                            <div class = "item form-group">
                                <label class = "control-label col-md-3 col-sm-3 col-xs-12" for = "sistuacao"></label>
                                <div class = "col-md-6 col-sm-6 col-xs-12">
                                    <label>
                                        <input type = "checkbox" name = "situacao" class = "js-switch" <?= ($status == 1 ? 'checked' : '') ?> /> Situação
                                    </label>
                                </div>
                            </div>
                            <div class = "ln_solid"></div>
                            <div class = "form-group">
                                <div class = "col-md-6 col-md-offset-3">
                                    <button id="voltar" type="button" class="btn btn-primary">Cancelar</button>
                                    <button id="salvar-cad" type = "submit" class = "btn btn-success">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/page content -->
