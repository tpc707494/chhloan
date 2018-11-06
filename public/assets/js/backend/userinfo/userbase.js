define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'userinfo/userbase/index',
                    add_url: 'userinfo/userbase/add',
                    edit_url: 'userinfo/userbase/edit',
                    del_url: 'userinfo/userbase/del',
                    multi_url: 'userinfo/userbase/multi',
                    table: 'user_base_info',
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
                        {field: 'real_name', title: __('Real_name')},
                        {field: 'sfznumber', title: __('Sfznumber')},
                        {field: 'home_addr', title: __('Home_addr')},
                        {field: 'sex', title: __('Sex')},
                        {field: 'minzu', title: __('Minzu')},
                        {field: 'job', title: __('Job')},
                        {field: 'wages', title: __('Wages')},
                        {field: 'yinghangka', title: __('Yinghangka')},
                        {field: 'yinghangname', title: __('Yinghangname')},
                        {field: 'yinhangkatype', title: __('Yinhangkatype')},
                        {field: 'yinghang_phone', title: __('Yinghang_phone')},
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