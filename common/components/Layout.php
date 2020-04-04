<?php

namespace common\components;

/**
 * Class Layout
 * @package common\components
 */
class Layout
{

    const BTN_ADD_LABEL = 'Novo';
    const BTN_SUBMIT_LABEL = 'Salvar';
    const BTN_FILTER_LABEL = 'Filtrar';
    const BTN_LIMPAR_LABEL = 'Limpar';
    const BTN_VOLTAR_LABEL = 'Voltar';
    const BTN_PROCESSAR_LABEL = 'Processar';

    const BTN_ACTION = 'btn btn-success ';
    const BTN_NOVO = 'btn btn-success ';
    const BTN_DEFAULT = 'btn btn-outline-secondary';
    const BTN_SUBMIT = 'btn btn-primary';
    const BTN_FILTER = 'btn btn-info';
    const BTN_LIMPAR = 'btn btn-outline-secondary';
    const BTN_OPCOES_GRUPO = 'btn btn-outline-secondary btn-opcoes-grupo';



    const BADGE_PRIMARY = 'badge badge-primary span-actions-columns';
    const BADGE_WARNING = 'badge badge-warning span-actions-columns';
    const BADGE_DANGER = 'badge badge-danger span-actions-columns';
    const BADGE_LIGHT = 'badge badge-light span-actions-columns';


    const GRID_STRIPED = true;
    const GRID_HOVER = true;
    const GRID_BORDERED = false;
    const GRID_CONDENSED = true;
    const GRID_PAJAX = false;
    const GRID_RESPONSIVE = true;
    const GRID_RESPONSIVE_WRAP = false;

    const BTN_VOLTAR = 'btn btn-muted  ';

    const BTN_DELETE = 'btn btn-danger ';
    const BTN_DELETE_LABEL = 'Excluir';

    const BTN_FOLDER = 'btn btn-action btn-xs';

    const BTN_SECUNDARY = 'btn btn-primary ';
    const BTN_PRIMARY = 'btn btn-primary ';
    const BTN_EXPORT = 'btn btn-outline-dark ';
    const BTN_SHOW_FORM = 'btn btn-outline-dark  ';
    const BTN_VOLTAR_TOPO = 'btn btn-default ';

    const GRID_LAYOUT = "\n{items}\n
        <div class='row'>
            <div class='col-md-8'>
                {pager}
            </div>
            <div class='col-md-4' style='float: right; margin-top: 25px; text-align: right'>
                {summary}
            </div>
        </div>
    ";

}
