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

  // Verzamel alle kolommen over alle submits
  function getAllColumns(data) {
    const keys = new Set();
    data.forEach((obj) =>
      Object.keys(obj)
        .filter((k) => k !== "form_id") // exclude form_id from columns
        .forEach((k) => keys.add(k))
    );
    return Array.from(keys).map((k) => ({ title: k, data: k }));
  }

  // Render DataTable met filter op currentFormID
  function renderTable() {
    const allData = window.getForminatorSessionData();
    if (!currentFormID) return;

    // Filter alleen entries van dit form_id
    const filteredData = allData.filter((row) => row.form_id === currentFormID);

    if (filteredData.length === 0) return;

    console.log("DataTable render voor form_id:", currentFormID, filteredData);

    const columns = getAllColumns(filteredData);

    if (!table) {
      table = $("#forminator-table").DataTable({
        data: filteredData,
        columns: columns,
        dom: "Bfrtip",
        buttons: ["copy", "excel", "csv", "pdf", "print"],
      });
    } else {
      table.clear().rows.add(filteredData).draw();
    }
  }

  // Bij succesvolle Forminator-submit
  $(document).on("forminator:form:submit:success", function (e, formData) {
    // Haal form_id uit hidden input
    currentFormID =
      $(document).find('input[name="form_id"]').val() || "unknown_form";

    // Bewaar currentFormID in sessionStorage (voor na redirect)
    sessionStorage.setItem("forminator_current_form_id", currentFormID);

    console.log("Current Form ID bij submit:", currentFormID);

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
      "form_id", // uit formData filteren, want we voegen hem zelf toe
    ];

    formData.forEach((value, key) => {
      if (!metaFields.includes(key)) {
        const label = getLabelFromDOM(key);
        obj[label] = value;
      }
    });

    // Voeg current form_id toe
    obj["form_id"] = currentFormID;

    // Bewaar ALLE entries in sessionStorage
    let allData = window.getForminatorSessionData();
    allData.push(obj);
    sessionStorage.setItem("forminator_data_array", JSON.stringify(allData));

    console.log("Alle submits opgeslagen:", allData);

    // Render alleen gefilterde entries
    renderTable();
  });

  // Bij paginalaad: haal currentFormID terug uit sessionStorage
  currentFormID = sessionStorage.getItem("forminator_current_form_id");
  if (currentFormID) {
    console.log("Current Form ID bij paginalaad:", currentFormID);
    renderTable();
  }
});
