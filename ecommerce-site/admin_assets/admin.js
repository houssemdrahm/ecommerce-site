// Fonction pour valider les formulaires
function validateForm() {
    const form = document.forms["adminForm"];
    const email = form["email"].value;
    const password = form["password"].value;
    let valid = true;
    let errorMessage = "";

    // Vérifier si le champ email est vide
    if (email === "") {
        errorMessage += "L'email est requis.\n";
        valid = false;
    }

    // Vérifier si le mot de passe est vide
    if (password === "") {
        errorMessage += "Le mot de passe est requis.\n";
        valid = false;
    }

    // Vérifier l'email avec une expression régulière simple
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        errorMessage += "L'email n'est pas valide.\n";
        valid = false;
    }

    if (!valid) {
        alert(errorMessage);
    }

    return valid;
}

// Fonction pour confirmer la suppression d'un élément
function confirmDelete() {
    return confirm("Êtes-vous sûr de vouloir supprimer cet élément ?");
}

// Fonction pour filtrer les résultats dans un tableau
function filterTable() {
    const input = document.getElementById("filterInput");
    const filter = input.value.toLowerCase();
    const table = document.getElementById("dataTable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        let rowContainsFilter = false;

        for (let j = 0; j < cells.length; j++) {
            const cell = cells[j];
            if (cell) {
                if (cell.innerHTML.toLowerCase().indexOf(filter) > -1) {
                    rowContainsFilter = true;
                    break;
                }
            }
        }

        rows[i].style.display = rowContainsFilter ? "" : "none";
    }
}

// Événements pour la validation des formulaires
document.addEventListener("DOMContentLoaded", () => {
    const forms = document.querySelectorAll("form");
    forms.forEach(form => {
        form.addEventListener("submit", function(event) {
            if (!validateForm()) {
                event.preventDefault(); // Empêche l'envoi si le formulaire n'est pas valide
            }
        });
    });

    // Événement pour le filtrage de la table
    const filterInput = document.getElementById("filterInput");
    if (filterInput) {
        filterInput.addEventListener("keyup", filterTable);
    }
});
