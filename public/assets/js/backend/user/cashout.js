define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user/cashout/index',
                    add_url: 'user/cashout/add',
                    edit_url: 'user/cashout/edit',
                    del_url: 'user/cashout/del',
                    multi_url: 'user/cashout/multi',
                    table: 'cashout',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        // {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'user.username', title: __('Uid')},
                        // {field: 'cash_name', title: __('Cash_name')},
                        {field: 'caseout', title: __('Caseout')},
                        {field: 'free', title: __('Free')},
                        {field: 'real_value', title: __('RealValue')},
                        {field: 'cashout_account_type', title: __('Cashout Account Type')},
                        {field: 'cashout_type', title: __('Cashout Type')},
                        {field: 'cashout_account', title: __('Cashout Account')},
                        {field: 'caseout_status', title: __('Caseout Status'), formatter: Table.api.formatter.status},
                        {field: 'note', title: __('Note')},
                        {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange', sortable: true},
                        {field: 'verify_time', title: __('Verify_time'), operate:'RANGE', addclass:'datetimerange', sortable: true},
                        {field: 'transfer_time', title: __('Transfer_time'), operate:'RANGE', addclass:'datetimerange', sortable: true},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ],
                search: false,
                // clickToSe    lect:false,
            });

            

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});