(function ($) {
    const learningPageContent = $('#learningPageContent');

    // disable right click
    // document.addEventListener('contextmenu', event => event.preventDefault(), true);

    $(document).ready(function () {
        const allItems = $('.tab-item');

        if (allItems && allItems.length && defaultItemType && defaultItemType !== '' && defaultItemId && defaultItemId !== '') {
            for (const item of allItems) {
                const $item = $(item);
                const type = $item.attr('data-type');
                const id = $item.attr('data-id');

                if (type === defaultItemType && id === defaultItemId) {
                    $item.trigger('click');

                    const collapse = $item.closest('.collapse');

                    if (collapse) {
                        collapse.collapse('show');
                    }
                }
            }
        } else if (allItems) {
            const item = allItems[0];

            const $item = $(item);

            $item.trigger('click');

            const collapse = $item.closest('.collapse');

            if (collapse) {
                collapse.collapse('show');
            }
        }
    });


    $('body').on('click', '#collapseBtn', function () {
        const $tabs = $('.learning-page-tabs');

        $tabs.toggleClass('show');
    });

    if ($(window).width() < 992) {
        $('.learning-page-tabs').removeClass('show')
    }

    $('body').on('click', '.nav-item a', function () {
        const $tabs = $('.learning-page-tabs');

        if (!$tabs.hasClass('show')) {
            $tabs.addClass('show');
        }
    });

    $('body').on('click', '.tab-item,.tab-item-2', function () {
        const $this = $(this);

        if (!$this.hasClass('active')) {
            const type = $this.attr('data-type');
            const id = $this.attr('data-id');

            //
            $('.tab-item-info').slideUp();
            $('.tab-item').removeClass('active');
            $('.certificate-item').removeClass('active');

            $this.addClass('we');
            $this.find('.tab-item-info').slideDown();

            if ($(window).width() < 992) {
                $('.learning-page-tabs').removeClass('show')
            }

            addContentLoading();

            handleContent(id, type);
        }
    });

    $('body').on('click', '#checkAgainSession', function () {
        const $this = $(this);

        const type = $this.attr('data-type');
        const id = $this.attr('data-id');

        addContentLoading();

        handleContent(id, type);
    });

    $('body').on('click', '.certificate-item', function () {
        const $this = $(this);

        $('.certificate-item').removeClass('active');
        $('.tab-item').removeClass('active');
        $this.addClass('active');

        const result = $this.attr('data-result');

        handleDownloadCertificateHtml(result);
    });


    function handleContent(itemId, itemType) {

        const data = {
            type: itemType,
            id: itemId,
        };

        $.post('/course/learning/itemInfo', data, function (result) {
            if (itemType === 'session') {
                const {session} = result;

                if (session) {
                    if (session.is_finished) {
                        handleLiveSessionFinishedHtml(session);
                    } else if (session.is_started) {
                        handleLiveSessionHtml(session);
                    } else {
                        handleLiveSessionNotStartedHtml(session);
                    }
                }
            } else if (itemType === 'file') {
                handleFileHtml(result.file); // if file is downloadable
            } else if (itemType === 'text_lesson') {
                handleTextLessonHtml(result.textLesson);
            } else if (itemType === 'quiz') {
                handleQuizHtml(result.quiz);
            }
        });
    }


    function handleDownloadCertificateHtml(result) {

        const title = downloadCertificateLang;
        const hint = enjoySharingYourCertificateWithOthersLang;
        const img = 'quiz.svg';

        let otherHtml = '';

        if (result && result !== '') {
            otherHtml = `
                <a style="z-index:1;" href="/panel/quizzes/results/${result}/downloadCertificate" target="_blank" class="btn btn-primary btn-sm mt-15">${downloadLang}</a>
            `;
        } else {
            otherHtml = `
                <button type="button" disabled class="btn btn-primary btn-sm mt-15">${downloadLang}</button>
            `;
        }

        const html = handleContentBoxHtml(title, hint, img, otherHtml);

        learningPageContent.html(html);
    }

    function handleQuizHtml(quiz) {

        const title = quiz.title;
        const hint = goToTheQuizPageForMoreInformationLang;
        const img = 'quiz.svg';

        let otherHtml = '';

        if (quiz.can_try) {
            otherHtml = `
                <a style="z-index:1;" href="/panel/quizzes/${quiz.id}/start" target="_blank" class="btn btn-primary btn-sm mt-15">${quizPageLang}</a>
            `;
        } else {
            otherHtml = `
                <button type="button" disabled class="btn btn-primary btn-sm mt-15">${quizPageLang}</button>
            `;
        }

        const html = handleContentBoxHtml(title, hint, img, otherHtml);

        learningPageContent.html(html);
    }

    function handleLiveSessionFinishedHtml(session) {

        const title = sessionIsFinishedLang;
        const hint = sessionIsFinishedHintLang;
        const img = 'live_session.svg';
        const otherHtml = `
                <a href="${courseUrl}" class="btn btn-white btn-sm mt-15">${coursePageLang}</a>
        `;

        const html = handleContentBoxHtml(title, hint, img, otherHtml, 'mt-10');

        learningPageContent.html(html);
    }

    function handleLiveSessionNotStartedHtml(session) {

        const title = sessionIsNotStartedYetLang;
        const hint = thisSessionWillBeStartedOnLang + ' ' + session.start_data;
        const img = 'live_session.svg';
        const otherHtml = `
            <div class="d-flex align-items-center mt-15">
                <button type="button" id="checkAgainSession" data-type="session" data-id="${session.id}" class="btn btn-primary btn-sm ">${checkAgainLang}</button>
            </div>
        `;

        const html = handleContentBoxHtml(title, hint, img, otherHtml, 'mt-10');

        learningPageContent.html(html);
    }

    function handleLiveSessionHtml(session) {
        const getDays = (year, month) => {
            return new Date(year, month, 0).getDate();
        };
    
        const d = new Date();
    
        const month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
    
        const days = getDays(new Date().getFullYear(), month[d.getMonth()]);
        // $(document).ready(function() {
        //     // $('#loader').addClass('loaded');
    
        // const noClass = document.getElementById("noClass");
        // });
        // <a href="${session.join_url}" target="_blank" class="btn btn-primary btn-sm font-16 ${d.getDate() == 29 || d.getDate() == 30 ? 'd-none' : ''}">${joinTheClassLang}</a>

        const title = sessionIsLiveLang;
        const courseTitle = session.slug
        const hint = youCanJoinTheLiveNowLang;
        const img = 'live_session.svg';
        const otherHtml = `
            <div class="d-flex align-items-center mt-15" style="z-index: 1;">
                <a href="${session.join_url}" target="_blank" class="btn btn-primary btn-sm font-16">${joinTheClassLang}</a>
            </div>
        `;
    
        const titleHtml = `<h4 class="font-weight-bold text-dark" style="margin-bottom: 12px;font-size: 24px;">${courseTitle}</h4>`
        const html = handleContentBoxHtml(title, hint, img, otherHtml, 'mt-10',titleHtml);

        learningPageContent.html(html);
    }

    function handleFileHtml(file) {

        if (file.downloadable && (file.downloadable === "1" || file.downloadable === 1)) {
            const title = downloadTheFileLang;
            const hint = file.title;
            const img = 'download.svg';
            const otherHtml = `<a href="${courseUrl}/file/${file.id}/download" style="z-index: 1;" class="btn btn-primary btn-sm mt-15" target="_blank">${downloadLang}</a>`;

            const html = handleContentBoxHtml(title, hint, img, otherHtml);

            learningPageContent.html(html);
        } else {
            switch (file.storage) {
                case 'upload':
                case 'youtube':
                case 'vimeo':
                case 'external_link':
                case 's3':

                    const $html = $('<div class="learning-content-video-player w-100"></div>');

                    learningPageContent.html($html);

                    handleVideoByFileId(file.id, $html, function () {

                    });

                    break;

                case 'google_drive':
                case 'iframe':
                    handleFileIframe(file.id);
                    break;
                case 'upload_archive':
                    const title = showHtmlFileLang;
                    const hint = file.title;
                    const img = 'download.svg';
                    const otherHtml = `<a href="${courseUrl}/file/${file.id}/showHtml" target="_blank" class="btn btn-primary btn-sm mt-15">${showLang}</a>`;

                    const html = handleContentBoxHtml(title, hint, img, otherHtml);

                    learningPageContent.html(html);
                    break;
            }

        }
    }

    function handleTextLessonHtml(textLesson) {
        let html = `<div class="text-lesson-content p-15 p-lg-30">
                    <h4 class="font-16 font-weight-bold text-dark">${textLesson.title}wwewe</h4>
                    <div class="pb-5 mt-15 main-image rounded-lg">
                        <img src="${textLesson.image}" class="img-cover bg-gray200" alt="${textLesson.title}"/>
                    </div>

                    ${textLesson.content}
                </div>`;

        if (textLesson.attachments && Object.keys(textLesson.attachments).length) {
            html += `<div class="shadow-sm rounded-lg bg-white px-15 px-md-25 py-20 mt-20">
                    <h3 class=" font-16 font-weight-bold text-dark-blue">${attachmentsLang}</h3>

                    <div class="row mt-10">
                    `;

            Object.keys(textLesson.attachments).forEach(key => {
                const attachment = textLesson.attachments[key];

                html += `<div class="col-12 col-lg-3 mt-10 mt-lg-0">
                            <a href="${courseUrl}/file/${attachment.file.id}/download" class="d-flex align-items-center p-10 border border-gray200 rounded-sm">
                                <span class="chapter-icon bg-gray300 mr-10">
                                    <i data-feather="download-cloud" class="text-gray" width="16" height="16"></i>
                                </span>

                                <div class="">
                                    <span class="font-weight-500 font-14 text-dark-blue d-block">Class Recording List</span>
                                    <span class="font-12 text-gray d-block">qweqwe${attachment.file.file_type} | ${attachment.file.volume}</span>
                                </div>
                            </a>
                    </div>`;
            });

            html += `</div>
                </div>`;

        }

        learningPageContent.html(html);

        feather.replace();
    }

    function handleContentBoxHtml(title, hint, img, html = null, titleClassName = null,titleHtml = null,) {
        return `<div class="d-flex align-items-center justify-content-center w-100 h-100">
                    <div class="learning-content-box d-flex align-items-center justify-content-center flex-column p-15 p-lg-30 rounded-lg">
                    ${titleHtml ?? ''}
                        <div class="learning-content-box-icon">
                            <img src="/assets/default/img/learning/${img}" alt="downloadable icon">
                        </div>
                        <h4 class="font-16 font-weight-bold text-dark ${titleClassName ?? ''}">${title}</h4>

                        <span class="font-14 font-weight-500 text-gray mt-5">${hint}</span>

                        ${html ?? ''}
                    </div>
                </div>`
            ;
    }

    function addContentLoading() {
        const html = `<div class="learning-content-loading d-flex align-items-center justify-content-center flex-column w-100 h-100">
            <img src="/assets/default/img/loading.gif" alt="">
            <p class="mt-10">${pleaseWaitForTheContentLang}</p>
        </div>`;

        learningPageContent.html(html);
    }

    function handleFileIframe(fileId) {
        $.post('/course/getFilePath', {file_id: fileId}, function (result) {

            if (result && result.code === 200) {
                const {storage, path} = result;

                const $iframeHtml = `<div class="learning-content-iframe">
                            ${path}
                        </div>`;

                learningPageContent.html($iframeHtml);
            } else {
                $.toast({
                    heading: notAccessToastTitleLang,
                    text: notAccessToastMsgLang,
                    bgColor: '#f63c3c',
                    textColor: 'white',
                    hideAfter: 10000,
                    position: 'bottom-right',
                    icon: 'error'
                });
            }
        }).fail(err => {
            $.toast({
                heading: notAccessToastTitleLang,
                text: notAccessToastMsgLang,
                bgColor: '#f63c3c',
                textColor: 'white',
                hideAfter: 10000,
                position: 'bottom-right',
                icon: 'error'
            });
        });
    }

    $('body').on('change', '.js-passed-lesson-toggle', function (e) {
        const $this = $(this);
        const course_id = $this.val();
        const item = $this.attr('data-item');
        const item_id = $this.attr('data-item-id');
        const status = this.checked;

        const data = {
            item: item,
            item_id: item_id,
            status: status
        };

        $.post('/course/' + course_id + '/learningStatus', data, function (result) {
            $.toast({
                heading: '',
                text: learningToggleLangSuccess,
                bgColor: '#43d477',
                textColor: 'white',
                hideAfter: 10000,
                position: 'bottom-right',
                icon: 'success'
            });
        }).fail(err => {
            $this.prop('checked', !status);

            $.toast({
                heading: '',
                text: learningToggleLangError,
                bgColor: '#f63c3c',
                textColor: 'white',
                hideAfter: 10000,
                position: 'bottom-right',
                icon: 'error'
            });
        });
    });
})(jQuery);
