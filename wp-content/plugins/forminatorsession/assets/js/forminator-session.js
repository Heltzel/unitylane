jQuery(document).ready(function ($) {
  let table;
  let currentFormID = null;

  // Haal alle submits uit sessionStorage
  window.getForminatorSessionData = function () {
    const stored = sessionStorage.getItem("forminator_data_array");
    return stored ? JSON.parse(stored) : [];
  };

  // Functie om label uit DOM te halen (fallbacks)
  function getLabelFromDOM(name) {
    const field = $(`[name="${name}"]`).closest(".forminator-field");
    if (!field.length) return name;

    const lbl = field.find("label").first().text().trim();
    if (lbl) return lbl;

    const placeholder = field.find("[name]").attr("placeholder");
    if (placeholder) return placeholder;

    const aria = field.find("[name]").attr("aria-label");
    if (aria) return aria;

    return name; // fallback
  }

  // Render verticale DataTable met volgorde behouden en lege rijen voor hidden fields
  function renderVerticalTable() {
    const allData = window.getForminatorSessionData();
    if (!currentFormID) return;

    const filteredData = allData.filter((row) => row.form_id === currentFormID);
    if (filteredData.length === 0) return;

    // Volgorde van velden uit eerste submit behouden
    const firstEntry = filteredData[0];
    const fieldKeys = Object.keys(firstEntry).filter((k) => k !== "form_id");

    const tableData = [];

    fieldKeys.forEach((key) => {
      // Detecteer hidden fields (key begint met 'hidden' of 'hidde')
      if (/^hidde?n?-\d+$/i.test(key)) {
        // Voeg twee lege rijen toe
        tableData.push({ label: "", submit1: "" });
        tableData.push({ label: "", submit1: "" });
      } else {
        const row = { label: key };
        filteredData.forEach((entry, i) => {
          row["submit" + (i + 1)] = entry[key] || "";
        });
        tableData.push(row);
      }
    });

    // Dynamische kolommen
    const columns = [{ data: "label", title: "Label" }];
    filteredData.forEach((_, i) =>
      columns.push({ data: "submit" + (i + 1), title: "Submit " + (i + 1) })
    );

    // Render DataTable zonder sortering/paginering
    if (table) table.destroy();
    table = $("#forminator-table").DataTable({
      data: tableData,
      columns: columns,
      dom: "Bfrtip",
      buttons: ["copy", "excel", "csv", "pdf", "print"],
      paging: false,
      searching: true,
      ordering: false,
      info: false,
    });
  }

  // Bij succesvolle Forminator-submit
  $(document).on("forminator:form:submit:success", function (e, formData) {
    currentFormID = $('input[name="form_id"]').val() || "unknown_form";
    sessionStorage.setItem("forminator_current_form_id", currentFormID);

    let obj = {};
    const metaFields = [
      "page_id",
      "_wp_http_referer",
      "forminator_nonce",
      "render_id",
      "action",
      "current_url",
      "form_type",
      "referer_url",
      "form_id",
    ];

    formData.forEach((value, key) => {
      if (!metaFields.includes(key)) {
        const label = getLabelFromDOM(key);
        obj[label] = value;
      }
    });

    obj["form_id"] = currentFormID;

    const allData = window.getForminatorSessionData();
    allData.push(obj);
    sessionStorage.setItem("forminator_data_array", JSON.stringify(allData));

    renderVerticalTable();
  });

  // Bij paginalaad
  currentFormID = sessionStorage.getItem("forminator_current_form_id");
  if (currentFormID) renderVerticalTable();
});
