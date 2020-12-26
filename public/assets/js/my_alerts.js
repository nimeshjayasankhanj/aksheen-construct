/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
type = ['', 'info bg-info text-white', 'success bg-success text-white', 'warning bg-warning text-white', 'danger bg-danger text-white'];
// ico = ['', 'glyphicon glyphicon-ok', 'glyphicon glyphicon-ok', 'glyphicon glyphicon-info-sign', 'glyphicon glyphicon-remove'];
ico = ['', 'fas fa-check', 'fas fa-check', 'fas fa-info-circle','fas fa-times'];

notification = {

    showNotification: function (from, align, mes, t, ti) {

        data=true;
        $.notify({
            icon: ico[t],
            message: mes
        }, {
            type: type[t],
            timer: ti,
            placement: {
                from: from,
                align: align
            }

        });

    }

}

