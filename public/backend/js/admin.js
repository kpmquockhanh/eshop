$('.btn-remove').click(function () {
    let id = $(this).attr('data-id');
    let tr = $(this).parents('tr');
    let item = $(this).parents('.item-product');

    iziToast.question({
        timeout: 10000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Xóa',
        message: 'Bạn có chắc muốn xóa sản phầm này không?',
        position: 'center',
        buttons: [
            ['<button><b>Có</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                axios.post('/admin/products/remove', {id: id})
                    .then(function (res) {
                        if (res.data.status)
                        {
                            iziToast.success({
                                title: 'Thành công',
                                message: 'Xóa thành công!',
                                position: 'topCenter'
                            });
                            tr.slideUp("normal", function() { $(this).remove(); } );
                            item.fadeOut("500", function() { $(this).remove(); } );
                        }
                        else
                        {
                            iziToast.error({
                                title: 'Lỗi',
                                message: 'Đã xảy ra lỗi!',
                                position: 'topCenter'
                            });
                        }

                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>Không</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});

$('.change-show-status').on('change', function () {
    let button = $(this);
    let id = $(this).attr('data-id');
    iziToast.question({
        timeout: 10000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Thay đổi hiển thị',
        message: 'Bạn có muốn thay đổi hiển thị của sản phẩm này không?',
        position: 'center',
        buttons: [
            ['<button><b>Có</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                axios.post('/admin/products/change-status', {id: id})
                    .then(function (res) {
                        if (res.data.status)
                        {
                            if (button.prop('checked'))
                            {
                                button.siblings('i').fadeIn();
                                button.parent().addClass('btn-primary');
                            }
                            else
                            {
                                button.siblings('i').fadeOut();
                                button.parent().removeClass('btn-primary');
                            }

                            iziToast.success({
                                title: 'Thành công',
                                message: 'Đã thay đổi trạng thái!',
                                position: 'topCenter'
                            });
                        }
                        else
                        {
                            iziToast.error({
                                title: 'Lỗi',
                                message: 'Đã xảy ra lỗi!',
                                position: 'topCenter'
                            });
                        }

                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>Không</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                button.prop('checked', !button.prop('checked'));
                // console.log(button.prop('checked'));
            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});
$('.trigger-change-status').click(function () {
   $(this).find('.change-show-status').trigger('click');
});

$('#paginate').on('change', function () {
    $(this).parents('form').trigger('submit');
});

$('#sort').on('change', function () {
    $(this).parents('form').trigger('submit');
});

$('.btn-remove-saler').click(function () {
    let id = $(this).attr('data-id');
    let tr = $(this).parents('tr');

    iziToast.question({
        timeout: 10000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Xóa',
        message: 'Bạn có chắc muốn xóa sản saler này không?',
        position: 'center',
        buttons: [
            ['<button><b>Có</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                axios.post('/admin/salers/remove', {id: id})
                    .then(function (res) {
                        console.log(res);
                        if (res.data.status)
                        {
                            iziToast.success({
                                title: 'Thành công',
                                message: 'Xóa thành công!',
                                position: 'topCenter'
                            });
                            tr.slideUp("normal", function() { $(this).remove(); } );
                        }
                        else
                        {
                            iziToast.error({
                                title: 'Lỗi',
                                message: 'Xóa không thành công!',
                                position: 'topCenter'
                            });
                        }

                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>Không</button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});

$('.change-saler-status').on('click', function () {
    let button = $(this);
    let status = button.parents('tr').find('#saler-status');
    let tagI = button.find('i');
    let id = $(this).attr('data-id');
    iziToast.question({
        timeout: 2000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Thay đổi hiển thị',
        message: 'Bạn có muốn thay đổi trạng thái của saler này không?',
        position: 'center',
        buttons: [
            ['<button><b>Có</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                axios.post('/admin/salers/change-status', {id: id})
                    .then(function (res) {
                        if (res.data.status)
                        {
                            if (button.hasClass('btn-success'))
                            {
                                button.removeClass('btn-success');
                                button.addClass('btn-primary');

                                tagI.removeClass('fa-check');
                                tagI.addClass('fa-minus');

                                status.text('Kích hoạt');
                                status.removeClass('text-danger');
                                status.addClass('text-success');
                            }else{
                                button.addClass('btn-success');
                                button.removeClass('btn-primary');

                                tagI.addClass('fa-check');
                                tagI.removeClass('fa-minus');

                                status.text('Vô hiệu hóa');
                                status.addClass('text-danger');
                                status.removeClass('text-success');
                            }

                            iziToast.success({
                                title: 'Thành công',
                                message: 'Đã thay đổi trạng thái!',
                                position: 'topCenter'
                            });
                        }
                        else
                        {
                            // console.log(res);
                            iziToast.error({
                                title: 'Lỗi',
                                message: 'Thay đổi không thành công',
                                position: 'topCenter'
                            });
                        }
                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>Không</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});
$('body').on('click','.btn-optimize-image', function () {
    let that = $(this);
    let id = $(this).attr('data-id');
    let tr = $(this).parents('tr');
    let i = $(this).children('i');


    iziToast.question({
        timeout: 10000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Tối ưu ảnh',
        message: 'Bạn có muốn tối ưu ảnh này không?',
        position: 'center',
        buttons: [
            ['<button><b>Có</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                i.removeClass('fa-cog');
                i.addClass('fa-spinner');
                that.removeClass('btn-success');
                that.addClass('btn-danger');

                axios.post('/admin/products/optimize-image', {id: id})
                    .then(function (res) {
                        if (res.data.status)
                        {
                            // console.log(res);
                            tr.replaceWith(res.data.data);
                            iziToast.success({
                                title: 'Thành công',
                                message: 'Đã tối ưu ảnh thành công!',
                                position: 'topCenter'
                            });

                        }
                        else
                        {
                            console.log(res);
                            iziToast.error({
                                title: 'Lỗi',
                                message: 'Tối ưu không thành công',
                                position: 'topCenter'
                            });
                        }
                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>Không</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});
$('.btn-compress-all').on('click', function () {
    let i = $(this).children('i');
    let that = $(this);
    iziToast.question({
        timeout: 2000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Tối ưu ảnh',
        message: 'Bạn có muốn tối ưu toàn bộ ảnh không?',
        position: 'center',
        buttons: [
            ['<button><b>Có</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                i.removeClass('fa-cogs');
                i.addClass('fa-spinner fa-spin');
                that.removeClass('btn-success');
                that.addClass('btn-danger');

                axios.post('/admin/products/optimize-all-image')
                    .then(function (res) {
                        if (res.data.status)
                        {
                            // console.log(res);
                            iziToast.success({
                                title: 'Thành công',
                                message: 'Đã tối ưu ảnh thành công!',
                                position: 'topCenter'
                            });
                            i.addClass('fa-cogs');
                            i.removeClass('fa-spinner fa-spin');
                            that.addClass('btn-success');
                            that.removeClass('btn-danger');
                        }
                        else
                        {
                            console.log(res);
                            iziToast.error({
                                title: 'Lỗi',
                                message: 'Tối ưu không thành công',
                                position: 'topCenter'
                            });
                            i.addClass('fa-cogs');
                            i.removeClass('fa-spinner fa-spin');
                            that.addClass('btn-success');
                            that.removeClass('btn-danger');
                        }
                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>Không</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});

$('body').on('click','.btn-download', function (e) {
    e.preventDefault();
    let that = $(this);
    let index = $(this).attr('data-index');
    let tr = $(this).parents('tr');
    let i = $(this).children('i');


    iziToast.question({
        timeout: 10000,
        close: false,
        overlay: true,
        displayMode: 'once',
        id: 'question',
        zindex: 999,
        title: 'Crawl',
        message: 'Bạn có muốn crawl link này không?',
        position: 'center',
        buttons: [
            ['<button><b>Có</b></button>', function (instance, toast) {

                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                i.removeClass('fa-download');
                i.addClass('fa-spinner fa-spin');
                that.removeClass('btn-success');
                that.addClass('btn-danger');

                axios.post('/admin/crawler/crawl', {index: index})
                    .then(function (res) {
                        if (res.data.status)
                        {
                            // console.log(res);
                            iziToast.success({
                                title: 'Thành công',
                                message: 'Crawl thành công!',
                                position: 'topCenter'
                            });

                            tr.replaceWith(res.data.data);
                        }
                        else
                        {
                            // console.log(res);
                            iziToast.error({
                                title: 'Lỗi',
                                message: 'Crawl không thành công',
                                position: 'topCenter'
                            });

                            i.addClass('fa-download');
                            i.removeClass('fa-spinner fa-spin');
                            that.addClass('btn-success');
                            that.removeClass('btn-danger');
                        }
                    })
                    .catch(function (err) {
                        console.log(err);
                    });

            }, true],
            ['<button>Không</button>', function (instance, toast) {
                instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }],
        ],
        onClosing: function(instance, toast, closedBy){
            // console.info('Closing | closedBy: ' + closedBy);
        },
        onClosed: function(instance, toast, closedBy){
            // console.info('Closed | closedBy: ' + closedBy);
        }
    });
});
