package app.model;

public class Kelas {

    private int id;
    private int major_id;
    private String name;
    
    public Kelas(int id, int major_id, String name) {
        this.id = id;
        this.major_id = major_id;
        this.name = name;
    }

    public int getId() {
        return id;
    }

    public int getMajor_id() {
        return major_id;
    }

    public String getName() {
        return name;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setMajor_id(int major_id) {
        this.major_id = major_id;
    }

    public void setName(String name) {
        this.name = name;
    }
}
