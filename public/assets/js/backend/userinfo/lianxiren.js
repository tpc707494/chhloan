define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'userinfo/lianxiren/index',
                    add_url: 'userinfo/lianxiren/add',
                    edit_url: 'userinfo/lianxiren/edit',
                    del_url: 'userinfo/lianxiren/del',
                    multi_url: 'userinfo/lianxiren/multi',
                    table: 'user_lianxiren',
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
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'uid', title: __('Uid')},
                        {field: 'guanxi1', title: __('Guanxi1')},
                        {field: 'name1', title: __('Name1')},
                        {field: 'phone1', title: __('Phone1')},
                        {field: 'guanxi2', title: __('Guanxi2')},
                        {field: 'name2', title: __('Name2')},
                        {field: 'phone2', title: __('Phone2')},
                        {field: 'create_at', title: __('Create_at'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
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