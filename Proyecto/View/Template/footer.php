            </div>
        </div>
        <footer class="py-2 fixed-bottom">
            <p class="text-center text-muted">Copyright &copy; Jose Pedro Montoro | Enrique Guzman | 2022/2023</p>
        </footer>
        <?php if ($controller->page_error) { ?>
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="liveToast" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <rect width="100%" height="100%" fill="#ff0000"></rect>
                        </svg>

                        <strong class="me-auto">NOTIFICACIÓN</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?php echo $controller->page_error; ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($controller->page_success) { ?>
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="liveToast" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <rect width="100%" height="100%" fill="#28a745"></rect>
                        </svg>

                        <strong class="me-auto">NOTIFICACIÓN</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <?php echo $controller->page_success; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </body>
</html>
