
package app.model;

//Full texts
//id	
//year	
//amount	

public class Spp {
    private int id;
    private String year;
    private String amount;

    public Spp(int id, String year, String amount) {
        this.id = id;
        this.year = year;
        this.amount = amount;
    }

    public int getId() {
        return id;
    }

    public String getYear() {
        return year;
    }

    public String getAmount() {
        return amount;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setYear(String year) {
        this.year = year;
    }

    public void setAmount(String amount) {
        this.amount = amount;
    }
}
