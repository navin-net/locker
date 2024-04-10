// General scripts for all pages
$(function () {
    $(document).on('click', '.reload-captcha', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        $.ajax({ url: link + '?width=210&height=34', type: 'GET' }).done(function (data) {
            if (data) {
                $('.captcha-image').html(data);
            } else {
                sa_alert('Error!', 'Something went wrong.', 'error', true);
            }
        });
    });


    $(document).on('click', '.forgot-password', function (e) {
        e.preventDefault();
        prompt(lang.reset_pw, lang.type_email);
    });

    // open dropdown menu on hover (if width >= 768px)
    $('ul.nav li.dropdown').hover(
        function () {
            if (get_width() >= 767) {
                $(this).addClass('open');
            }
        },
        function () {
            if (get_width() >= 767) {
                $(this).removeClass('open');
            }
        }
    );

    // Dropdiwn submenu
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
    });

    // Tooltip
    $('.tip').tooltip({ container: 'body' });

    // Back top Top
    $(window).scroll(function () {
        if ($(this).scrollTop() > 70) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });

    sticky_con();
    $(window).resize(sticky_con);

    // Theme color
    $('.theme-color').click(function (e) {
        store('shop_color', $(this).attr('data-color'));
        $('#wrapper').removeAttr('class').addClass($(this).attr('data-color'));
        return false;
    });
    if ((shop_color = get('shop_color'))) {
        $('#wrapper').removeAttr('class').addClass(shop_color);
    }


    if (v == 'products') {

        $(window).resize(function () {
            gen_html(products);
        });


        // if (site.settings.products_page == 1) {
        //     $('.grid').isotope({ itemSelector: '.grid-item' });
        // }
        // Top search on products page - dont load page but recall ajax
        $('#product-search-form').submit(function (e) {
            e.preventDefault();
            filters.query = $('#product-search').val();
            filters.page = 1;
            searchProducts();
            return false;
        });

        $('#product-search').blur(function (e) {
            e.preventDefault();
            filters.query = $(this).val();
            filters.page = 1;
            searchProducts();
            return false;
        });

        $('#product-brand').change(function(e) {
            window.location = site.site_url+'brand/'+$(this).val();
        });

        $('#product-category').change(function(e) {
            window.location = site.site_url+'category/'+$(this).val();
        });

        // Filters - unselect brand
        $('.reset_filters_brand').click(function (e) {
            filters.brand = null;
            filters.page = 1;
            searchProducts();
            $(this).closest('li').remove();
        });
        // Filters - unselect category
        $('.reset_filters_category').click(function (e) {
            filters.category = null;
            filters.page = 1;
            searchProducts();
            $(this).closest('li').remove();
        });

        // Reload products if the min/max price or in stock val change
        $('#product-category, #product-brand, #min-price, #max-price, #in-stock, #promotions, #featured').change(function () {
            filters.page = 1;
            searchProducts();
        });

        $(document).on('click', '#pagination a', function (ev) {
            ev.preventDefault();
            var link = $(this).attr('href');
            var p = link.split('page=');
            if (p[1]) {
                var pp = p[1].split('&');
                filters.page = pp[0];
            } else {
                filters.page = 1;
            }
            searchProducts(link);
            return false;
        });

        // Get user selected grip and sorting and apply to page
        if ((shop_grid = get('shop_grid'))) {
            $(shop_grid).click();
        }
        
        if (filters.query) {
            $('#product-search').val(filters.query);
        }

        // Load products
        searchProducts();
    }

    // Featured products grid - hover view
    $('.product').each(function (i, el) {
        $(el)
            .find('.details')
            .hover(
                function () {
                    $(this).parent().css('z-index', '20');
                    $(this).addClass('animate');
                },
                function () {
                    $(this).removeClass('animate');
                    $(this).parent().css('z-index', '1');
                }
            );
    });

    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    }

    $(document).on('click', '.show-tab', function (e) {
        e.preventDefault();
        $('.nav-tabs a[href="#' + $(this).attr('href') + '"]').tab('show');
    });

    $('.history-tabs a').on('shown.bs.tab', function (e) {
        if (history.pushState) {
            history.pushState(null, null, e.target.hash);
        } else {
            window.location.hash = e.target.hash;
        }
    });

    $('.email-modal').click(function (e) {
        e.preventDefault();
        email_form();
    });

    $('#same_as_billing').change(function (e) {
        if ($(this).is(':checked')) {
            $('#shipping_line1').val($('#billing_line1').val()).change();
            $('#shipping_line2').val($('#billing_line2').val()).change();
            $('#shipping_city').val($('#billing_city').val()).change();
            $('#shipping_state').val($('#billing_state').val()).change();
            $('#shipping_postal_code').val($('#billing_postal_code').val()).change();
            $('#shipping_country').val($('#billing_country').val()).change();
            $('#shipping_phone').val($('#phone').val()).change();
            $('#guest-checkout').data('formValidation').resetForm();
        }
    });
});

function sa_img(title, msg) {
    swal({
        title: title,
        html: msg,
        type: 'success',
        confirmButtonText: lang.okay,
    }).catch(swal.noop);
}



// Sticky Container
function sticky_con() {
    if (get_width() > 767) {
        $('#sticky-con').stick_in_parent({ parent: $('.container') });
        $('#sticky-con')
            .on('sticky_kit:bottom', function (e) {
                $(this).parent().css('position', 'static');
            })
            .on('sticky_kit:unbottom', function (e) {
                $(this).parent().css('position', 'relative');
            });
    } else {
        $('#sticky-con').trigger('sticky_kit:detach');
    }
}


// Get body width
function get_width() {
    return $(window).width();
}

// Show loading animation for n miliseconds
function loading(n) {
    $('#loading').show();
    setTimeout(function () {
        $('#loading').hide();
    }, n);
}

// Get localStorage item
function get(name) {
    if (typeof Storage !== 'undefined') {
        return localStorage.getItem(name);
    } else {
        alert('Please use a modern browser as this site needs localstroage!');
    }
}

// Set localStorage item
function store(name, val) {
    if (typeof Storage !== 'undefined') {
        localStorage.setItem(name, val);
    } else {
        alert('Please use a modern browser as this site needs localstroage!');
    }
}

// Remove localStorage item
function remove(name) {
    if (typeof Storage !== 'undefined') {
        localStorage.removeItem(name);
    } else {
        alert('Please use a modern browser as this site needs localstroage!');
    }
}

function gen_html(products) {
    var self = this;
    var html = '';

    if (!products) {
        html +=
            '<div class="col-sm-12"><div class="alert alert-warning text-center padding-xl margin-top-lg"><h4 class="margin-bottom-no">' +
            lang.x_product +
            '</h4></div></div>';
    }

    if (site.settings.products_page == 1) {
        $('#results').empty();
        // $('.grid').isotope('destroy').isotope();
    }

    $.each(products, function (index, product) {
        var nprice = product.special_price ? product.special_price : product.price;
        var fnprice = product.special_price ? product.formated_special_price : product.formated_price;
        var pprice = product.promotion && product.promo_price && product.promo_price != 0 ? product.promo_price : nprice;
        var fpprice = product.promotion && product.promo_price && product.promo_price != 0 ? product.formated_promo_price : fnprice;

        html +=`
                  <!-- Isotope Item Start -->
                  <div class="isotope-item cat1 cat3">
                    <div class="isotope-item-inner">
                      <div class="product">
                        <div class="product-header">
                          <span class="onsale">Sale!</span>
                          <div class="thumb image-swap">
                            <a href="${site.site_url}product/${product.slug}"><img src="${site.base_url}assets/uploads/${product.image}" class="product-main-image img-responsive img-fullwidth" alt="product" style="background-size: cover; width: 250px; height: 250px;"></a>
                            <a href="${site.site_url}product/${product.slug}"><img src="${site.base_url}assets/uploads/${product.image}" class="product-hover-image img-responsive img-fullwidth" alt="product" style="background-size: cover; width: 250px; height: 250px;"></a>
                          </div>
                          <div class="product-button-holder">
                            <ul class="shop-icons">
                              <li class="item"><a href="${site.site_url}product/${product.slug}" class="button btn-quickview" title="Product quick view"></a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="product-details">
            
                          <h5 class="product-title"><a href="${site.site_url}product/${product.slug}">${product.name}</a></h5>
                          <span class="price">
                             ${product.promo_price ? '<del><span class="amount"><span class="currency-symbol">£</span>18.00</span>' + fnprice + '</del>' : ''}
                            
                            <ins><span class="amount">${fpprice}</span></ins>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Isotope Item End -->
                `;

        if (site.settings.products_page != 1) {
            if (index + 1 === products.length) {
                html += '</div>';
            }
        }
    });
    //${(product.type != 'standard' || product.quantity > 0) ? '' : 'disabled="true"'}

    if (site.settings.products_page != 1) {
        $('#results').empty();
        $(html).appendTo($('#results'));
    } else {
        var data = $(html);
        $('.grid').isotope('insert', data).isotope('layout');
        setTimeout(function () {
            $('.grid').isotope({ itemSelector: '.grid-item' });
        }, 200);
    }
}

// Seach products
function searchProducts(link) {
    if (history.pushState) {
        var newurl = window.location.origin + window.location.pathname + '?page=' + filters.page;
        // var newurl = window.location.protocol + '//' + window.location.host + window.location.pathname + '?page=' + filters.page;
        window.history.pushState({ path: newurl, filters: filters }, '', newurl);
    }
    $('#loading').show();
    var data = {};
    data[site.csrf_token] = site.csrf_token_value;
    var x = get_filters();
    // alert(x);
    data['filters'] = get_filters();
    data['format'] = 'json';
    $.ajax({ url: site.shop_url + 'search?page=' + filters.page, type: 'POST', data: data, dataType: 'json' })
        .done(function (data) {
            products = data.products;
            $('.page-info').empty();
            $('#pagination').empty();
            if (data.products) {
                if (data.pagination) {
                    $('#pagination').html(data.pagination);
                }
                if (data.info) {
                    $('.page-info').text(lang.page_info.replace('_page_', data.info.page).replace('_total_', data.info.total));
                }
            }
            gen_html(products);
        })
        .always(function () {
            $('#loading').hide();
        });
    if (location.href.includes('products')) {
        if (link) {
            window.history.pushState({ link: link, filters: filters }, '', link);
            window.onpopstate = function (e) {
                if (e.state && e.state.filters) {
                    filters = e.state.filters;
                    searchProducts();
                } else {
                    filters.page = 1;
                    searchProducts();
                }
            };
        }
    }
    setTimeout(function () {
        window.scrollTo(0, 0);
    }, 500);
}

// Get page filters
function get_filters() {
    filters.min_price   = $('#min-price').val();
    filters.max_price   = $('#max-price').val();
    filters.in_stock    = $('#in-stock').is(':checked') ? 1 : 0;
    filters.promo       = $('#promotions').is(':checked') ? 'yes' : 0;
    filters.featured    = $('#featured').is(':checked') ? 'yes' : 0;
    filters.sorting     = get('sorting');
    return filters;
}




// Format Money - for products price
function formatMoney(x, symbol) {
    if (!symbol) {
        symbol = site.settings.symbol;
    }
    if (site.settings.sac == 1) {
        return (
            (site.settings.display_symbol == 1 ? symbol : '') +
            '' +
            formatSA(parseFloat(x).toFixed(site.settings.decimals)) +
            (site.settings.display_symbol == 2 ? symbol : '')
        );
    }
    var fmoney = accounting.formatMoney(
        x,
        symbol,
        site.settings.decimals,
        site.settings.thousands_sep == 0 ? ' ' : site.settings.thousands_sep,
        site.settings.decimals_sep,
        '%s%v'
    );
    return (site.settings.display_symbol == 1 ? symbol : '') + fmoney + (site.settings.display_symbol == 2 ? symbol : '');
}

// Format helper fun for South Asian Currencies
function formatSA(x) {
    x = x.toString();
    var afterPoint = '';
    if (x.indexOf('.') > 0) afterPoint = x.substring(x.indexOf('.'), x.length);
    x = Math.floor(x);
    x = x.toString();
    var lastThree = x.substring(x.length - 3);
    var otherNumbers = x.substring(0, x.length - 3);
    if (otherNumbers != '') lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ',') + lastThree + afterPoint;
    return res;
}

function sa_alert(title, message, level, overlay) {
    level = level || 'success';
    overlay = overlay || false;
    swal({
        title: title,
        html: message,
        type: level,
        timer: overlay ? 60000 : 2000,
        confirmButtonText: 'Okay',
    }).catch(swal.noop);
}

function saa_alert(action, message, method, form_data) {
    method = method || lang.delete;
    message = message || lang.x_reverted_back;
    form_data = form_data || {};
    form_data._method = method;
    form_data[site.csrf_token] = site.csrf_token_value;
    swal({
        title: lang.r_u_sure,
        html: message,
        type: 'question',
        showCancelButton: true,
        allowOutsideClick: false,
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function () {
                $.ajax({
                    url: action,
                    type: 'POST',
                    data: form_data,
                    success: function (data) {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                            return false;
                        } else {
                            if (data.cart) {
                                cart = data.cart;
                                update_mini_cart(cart);
                                update_cart(cart);
                            }
                            sa_alert(data.status, data.message);
                        }
                    },
                    error: function () {
                        sa_alert('Error!', 'Ajax call failed, please try again or contact site owner.', 'error', true);
                    },
                });
            });
        },
    }).catch(swal.noop);
}

function prompt(title, message, form_data) {
    title = title || 'Reset Password';
    message = message || 'Please type your email address';
    form_data = form_data || {};
    form_data[site.csrf_token] = site.csrf_token_value;

    swal({
        title: title,
        html: message,
        input: 'email',
        showCancelButton: true,
        allowOutsideClick: false,
        showLoaderOnConfirm: true,
        cancelButtonText: lang.cancel,
        confirmButtonText: lang.submit,
        preConfirm: function (email) {
            form_data['email'] = email;
            return new Promise(function (resolve, reject) {
                $.ajax({
                    url: site.base_url + 'forgot_password',
                    type: 'POST',
                    data: form_data,
                    success: function (data) {
                        if (data.status) {
                            resolve(data);
                        } else {
                            reject(data);
                        }
                    },
                    error: function () {
                        sa_alert('Error!', 'Ajax call failed, please try again or contact site owner.', 'error', true);
                    },
                });
            });
        },
    }).then(function (data) {
        sa_alert(data.status, data.message);
    });
}

function add_address(address) {
    address = address || {};
    var astate = '';
    if (istates) {
        var selectList = document.createElement('select');
        selectList.id = 'address-state';
        selectList.name = 'state';
        selectList.className = 'selectpickerstate mobile-device';
        selectList.setAttribute('data-live-search', true);
        selectList.setAttribute('title', 'State');
        let iskeys = Object.keys(istates);
        iskeys.map(s => {
            if (s != 0) {
                var option = document.createElement('option');
                option.value = s;
                option.text = istates[s];
                selectList.appendChild(option);
            }
        });
        astate = selectList.outerHTML;
    } else {
        astate =
            '<input name="state" value="' +
            (address.state ? address.state : '') +
            '" id="address-state" class="form-control" placeholder="' +
            lang.state +
            '">';
    }
    swal({
        title: address.id ? lang.update_address : lang.add_address,
        html:
            '<span class="text-bold padding-bottom-md">' +
            lang.fill_form +
            '</span>' +
            '<hr class="swal2-spacer padding-bottom-xs" style="display: block;"><form action="' +
            site.shop_url +
            'address" id="address-form" class="padding-bottom-md">' +
            '<input type="hidden" name="' +
            site.csrf_token +
            '" value="' +
            site.csrf_token_value +
            '">' +
            '<div class="row"><div class="form-group col-sm-12"><input name="line1" id="address-line-1" value="' +
            (address.line1 ? address.line1 : '') +
            '" class="form-control" placeholder="' +
            lang.line_1 +
            '"></div></div>' +
            '<div class="row"><div class="form-group col-sm-12"><input name="line2" id="address-line-2" value="' +
            (address.line2 ? address.line2 : '') +
            '" class="form-control" placeholder="' +
            lang.line_2 +
            '"></div></div>' +
            '<div class="row">' +
            '<div class="form-group col-sm-6"><input name="city" value="' +
            (address.city ? address.city : '') +
            '" id="address-city" class="form-control" placeholder="' +
            lang.city +
            '"></div>' +
            '<div class="form-group col-sm-6" id="istates">' +
            astate +
            '</div>' +
            '<div class="form-group col-sm-6"><input name="postal_code" value="' +
            (address.postal_code ? address.postal_code : '') +
            '" id="address-postal-code" class="form-control" placeholder="' +
            lang.postal_code +
            '"></div>' +
            '<div class="form-group col-sm-6"><input name="country" value="' +
            (address.country ? address.country : '') +
            '" id="address-country" class="form-control" placeholder="' +
            lang.country +
            '"></div>' +
            '<div class="form-group col-sm-12 margin-bottom-no"><input name="phone" value="' +
            (address.phone ? address.phone : '') +
            '" id="address-phone" class="form-control" placeholder="' +
            lang.phone +
            '"></div>' +
            '</form></div>',
        showCancelButton: true,
        allowOutsideClick: false,
        cancelButtonText: lang.cancel,
        confirmButtonText: lang.submit,
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if (!$('#address-line-1').val()) {
                    reject(lang.line_1 + ' ' + lang.is_required);
                }
                // if (!$('#address-line-2').val()) { reject('Line 2 is required'); }
                if (!$('#address-city').val()) {
                    reject(lang.city + ' ' + lang.is_required);
                }
                if (!$('#address-state').val()) {
                    reject(lang.state + ' ' + lang.is_required);
                }
                // if (!$('#address-postal-code').val()) { reject('Postal code is required'); }
                if (!$('#address-country').val()) {
                    reject(lang.country + ' ' + lang.is_required);
                }
                if (!$('#address-phone').val()) {
                    reject(lang.phone + ' ' + lang.is_required);
                }
                resolve();
            });
        },
        onOpen: function () {
            $('#address-line-1')
                .val(address.line1 ? address.line1 : '')
                .focus();
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
                $('.selectpickerstate').selectpicker({ modile: true });
                $('.selectpickerstate').selectpicker('val', address.state ? address.state : '');
            } else {
                var elements = document.querySelectorAll('.mobile-device');
                for (var i = 0; i < elements.length; i++) {
                    elements[i].classList.remove('mobile-device');
                }
                $('.selectpickerstate').selectpicker({ size: 5 });
                $('.selectpickerstate').selectpicker('val', address.state ? address.state : '');
            }
        },
    })
        .then(function (data) {
            var $form = $('#address-form');
            // resolve($form)
            $.ajax({
                url: $form.attr('action') + (address.id ? '/' + address.id : ''),
                type: 'POST',
                data: $form.serialize(),
                success: function (data) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                        return false;
                    } else {
                        sa_alert(data.status, data.message, data.level);
                    }
                },
                error: function () {
                    sa_alert('Error!', 'Ajax call failed, please try again or contact site owner.', 'error', true);
                },
            });
        })
        .catch(swal.noop);
}

function email_form() {
    swal({
        title: lang.send_email_title,
        html:
            '<div><span class="text-bold padding-bottom-md">' +
            lang.fill_form +
            '</span>' +
            '<hr class="swal2-spacer padding-bottom-xs" style="display: block;"><form action="' +
            site.shop_url +
            'send_message" id="message-form" class="padding-bottom-md">' +
            '<input type="hidden" name="' +
            site.csrf_token +
            '" value="' +
            site.csrf_token_value +
            '">' +
            '<div class="row"><div class="form-group col-sm-12"><input type="text" name="name" id="form-name" value="" class="form-control" placeholder="' +
            lang.full_name +
            '"></div></div>' +
            '<div class="row"><div class="form-group col-sm-12"><input type="email" name="email" id="form-email" value="" class="form-control" placeholder="' +
            lang.email +
            '"></div></div>' +
            '<div class="row"><div class="form-group col-sm-12"><input type="text" name="subject" id="form-subject" value="" class="form-control" placeholder="' +
            lang.subject +
            '"></div></div>' +
            '<div class="row"><div class="col-sm-12"><textarea name="message" id="form-message" class="form-control" placeholder="' +
            lang.message +
            '" style="height:100px;"></textarea></div></div>' +
            '</form></div>',
        showCancelButton: true,
        allowOutsideClick: false,
        cancelButtonText: lang.cancel,
        confirmButtonText: lang.submit,
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if (!$('#form-name').val()) {
                    reject(lang.name + ' ' + lang.is_required);
                }
                if (!$('#form-email').val()) {
                    reject(lang.email + ' ' + lang.is_required);
                }
                if (!$('#form-subject').val()) {
                    reject(lang.subject + ' ' + lang.is_required);
                }
                if (!$('#form-message').val()) {
                    reject(lang.message + ' ' + lang.is_required);
                }
                if (!validateEmail($('#form-email').val())) {
                    reject(lang.email_is_invalid);
                }
                resolve();
            });
        },
        onOpen: function () {
            $('#form-name').focus();
        },
    })
        .then(function (data) {
            var $form = $('#message-form');
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (data) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                        return false;
                    } else {
                        sa_alert(data.status, data.message, data.level, true);
                    }
                },
                error: function () {
                    sa_alert('Error!', 'Ajax call failed, please try again or contact site owner.', 'error', true);
                },
            });
        })
        .catch(swal.noop);
}

function validateEmail(email) {
    var re =
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

var inputs = document.querySelectorAll('.file');
var submit_btn = document.querySelector('#submit-container');
if (submit_btn) {
    submit_btn.style.display = 'none';
}
Array.prototype.forEach.call(inputs, function (input) {
    var label = input.nextElementSibling,
        labelVal = label.innerHTML;

    input.addEventListener('change', function (e) {
        var fileName = '';
        if (this.files && this.files.length > 1) {
            fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            if (submit_btn) {
                submit_btn.style.display = 'inline-block';
            }
        } else {
            fileName = e.target.value.split('\\').pop();
            if (submit_btn) {
                submit_btn.style.display = 'none';
            }
        }

        if (fileName) {
            label.querySelector('span').innerHTML = fileName;
            if (submit_btn) {
                submit_btn.style.display = 'inline-block';
            }
        } else {
            label.innerHTML = labelVal;
            if (submit_btn) {
                submit_btn.style.display = 'none';
            }
        }
    });
});
