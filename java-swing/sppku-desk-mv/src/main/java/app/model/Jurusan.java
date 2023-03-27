package app.model;

public class Jurusan {
    private int id;
    private String name;

    public Jurusan(int id, String name) {
        this.id = id;
        this.name = name;
    }
    
    public Jurusan() {
        //
    }

    public int getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setName(String name) {
        this.name = name;
    }
    
}
