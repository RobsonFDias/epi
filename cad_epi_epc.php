<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form class="form-horizontal form-label-left" novalidate>

                            <span class="section">Cadastro Epi/Epc</span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Descrição <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" required="required" type="text">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tamanho">Tamanho <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="number" name="number" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">CA <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>Selecione</option>
                                        <option>Teste 1</option>
                                        <option>Teste 2</option>
                                        <option>Teste 3</option>
                                        <option>Teste 4</option>
                                        <option>Teste 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Natureza <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>Selecione</option>
                                        <option>Teste 1</option>
                                        <option>Teste 2</option>
                                        <option>Teste 3</option>
                                        <option>Teste 4</option>
                                        <option>Teste 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="password" class="control-label col-md-3">Estoque Minimo</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Vida Util <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" required="required" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label>
                                        <input type="checkbox" class="js-switch" checked /> Ativar Pedido Automatico
                                    </label>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="button" class="btn btn-primary">Cancelar</button>
                                    <button id="send" type="submit" class="btn btn-success">Cadastrar</button>
                                </div>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
