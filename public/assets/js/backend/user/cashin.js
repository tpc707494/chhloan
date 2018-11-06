define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'user/cashin/index',
                    add_url: 'user/cashin/add',
                    edit_url: 'user/cashin/edit',
                    del_url: 'user/cashin/del',
                    multi_url: 'user/cashin/multi',
                    table: 'cashin',
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
                        {field: 'id', title: __('Id'), sortable: true},
                        {field: 'user.username', title: __('Username')},
                        {field: 'cashin_account_type', title: __('Account Type'), operate: 'LIKE'},
                        {field: 'cashin', title: __('Cashin Value'), operate: 'LIKE'},
                        {field: 'pay_code', title: __('Cashin Code'), operate: 'LIKE'},
                        {field: 'cashin_staut', title: __('Cashin Staut'), operate: 'LIKE'},
                        {field: 'goods.goods', title: __('Cashin Type'), operate: 'LIKE'},
                        {field: 'created_at', title: __('Creat Time'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        {field: 'updated_at', title: __('Update Time'), formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        // {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ],
                search: false,
                // clickToSelect:false,
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