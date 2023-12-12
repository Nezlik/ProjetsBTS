package GestionDesAdherents;

import java.util.Date;

public class Adherent {

    // Attributs
    private int id;
    private String prenom;
    private String nom;
    private Date dateAniv;
    private String genre;
    private String paysNaiss;
    private String nationalite;
    private String adresse;
    private int CP;
    private String ville;
    private int numTel;
    private String mail;
    private String tuteur;
    private int categorie;
    
    // Constructeur
    public Adherent(int id, String prenom, String nom, Date dateAniv, String genre, String paysNaiss,
            String nationalite, String adresse, int CP, String ville, int numTel, String mail,
            String tuteur, int categorie) {
        super();
        this.id = id;
        this.prenom = prenom;
        this.nom = nom;
        this.dateAniv = dateAniv;
        this.genre = genre;
        this.paysNaiss = paysNaiss;
        this.nationalite = nationalite;
        this.adresse = adresse;
        this.CP = CP;
        this.ville = ville;
        this.numTel = numTel;
        this.mail = mail;
        this.tuteur = tuteur;
        this.categorie = categorie;
    }

    // Méthodes getters
    public int getId() {
        return id;
    }

    public String getPrenom() {
        return prenom;
    }

    public String getNom() {
        return nom;
    }

    public Date getDateAniv() {
        return dateAniv;
    }

    public String getGenre() {
        return genre;
    }

    public String getPaysNaiss() {
        return paysNaiss;
    }

    public String getNationalite() {
        return nationalite;
    }

    public String getAdresse() {
        return adresse;
    }

    public int getCP() {
        return CP;
    }

    public String getVille() {
        return ville;
    }

    public int getNumTel() {
        return numTel;
    }

    public String getMail() {
        return mail;
    }

    public String getTuteur() {
        return tuteur;
    }

    public int getCategorie() {
        return categorie;
    }

    public int getFraisAdhesion() {
        int frais = 0;
        switch (this.categorie) {
            case 1:
            case 2:
            case 3:
            case 4:
                frais = 190;
                break;
            case 5:
            case 6:
            case 7:
            case 8:
                frais = 220;
                break;
            case 9:
            case 10:
                frais = 255;
                break;
            default:
                System.out.println("Erreur dans la catégorie de l'adhérent");
        }
        return frais;
    }

    // Méthodes setters
    public void setPrenom(String prenom) {
        this.prenom = prenom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }

    public void setDateAniv(Date dateAniv) {
        this.dateAniv = dateAniv;
    }

    public void setGenre(String genre) {
        this.genre = genre;
    }

    public void setPaysNaiss(String paysNaiss) {
        this.paysNaiss = paysNaiss;
    }

    public void setNationalite(String nationalite) {
        this.nationalite = nationalite;
    }

    public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

    public void setCP(int CP) {
        this.CP = CP;
    }

    public void setVille(String ville) {
        this.ville = ville;
    }

    public void setNumTel(int numTel) {
        this.numTel = numTel;
    }

    public void setMail(String mail) {
        this.mail = mail;
    }

    public void setTuteur(String tuteur) {
        this.tuteur = tuteur;
    }

    public void setCategorie(int categorie) {
        this.categorie = categorie;
    }
}
