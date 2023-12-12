package GestionDesAdherents;

import java.util.ArrayList;
import java.util.List;

public class Gestion {

    // Attribut pour stocker les adhérents
    private List<Adherent> lesAdherents;

    // Constructeur
    public Gestion() {
        lesAdherents = new ArrayList<>();
    }

    // Méthode pour ajouter un adhérent
    public boolean addAdherent(Adherent adh) {
        boolean isAdded = false;
        if (!lesAdherents.contains(adh)) {
            isAdded = true;
            lesAdherents.add(adh);
        }
        return isAdded;
    }

    // Méthode pour supprimer un adhérent
    public boolean supprAdherent(Adherent adh) {
        boolean isRemoved = false;
        if (lesAdherents.contains(adh)) {
            lesAdherents.remove(adh);
            isRemoved = true;
        }
        return isRemoved;
    }

    // Méthode pour rechercher un adhérent
    public boolean searchAdherent(Adherent adh) {
        return lesAdherents.contains(adh);
    }

    // Méthode pour obtenir la liste des adhérents
    public List<Adherent> getAdherents() {
        return this.lesAdherents;
    }
}
