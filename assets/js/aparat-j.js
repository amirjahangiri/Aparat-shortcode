jQuery(document).ready(function ($) {
  // Show modal on button click
  $("#aparat-insert-button").on("click", function () {
    const modalHTML = `
              <div class="modal fade" id="aparatModal" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">اضافه کردن ویدیو آپارات</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <div class="mb-3">
                                  <label for="aparat-link" class="form-label">لینک آپارات:</label>
                                  <input type="text" dir="ltr" id="aparat-link" class="form-control" placeholder="https://www.aparat.com/v/g60o88t">
                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                              <button type="button" id="insert-aparat-shortcode" class="btn btn-primary">اضافه کردن</button>
                          </div>
                      </div>
                  </div>
              </div>`;
    $("body").append(modalHTML);
    const modal = new bootstrap.Modal(document.getElementById("aparatModal"));
    modal.show();

    // Handle insert button
    $("#insert-aparat-shortcode").on("click", function () {
      const link = $("#aparat-link").val();
      const id = link.split("/v/")[1];
      if (id) {
        const shortcode = `[aparat-j id="${id}"]`;
        wp.media.editor.insert(shortcode);
        modal.hide();
        $("#aparatModal").remove();
      } else {
        alert("لینک نامعتبر است.");
      }
    });

    // Remove modal on close
    $("#aparatModal").on("hidden.bs.modal", function () {
      $("#aparatModal").remove();
    });
  });
});
