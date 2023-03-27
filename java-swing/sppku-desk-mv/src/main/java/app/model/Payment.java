
package app.model;

public class Payment {
    private int id;
    private int user_id;
    private String nisn;
    private int spp_id;
    private String pay_on;
    private int total;

    public Payment(int id, int user_id, String nisn, int spp_id, String pay_on, int total) {
        this.id = id;
        this.user_id = user_id;
        this.nisn = nisn;
        this.spp_id = spp_id;
        this.pay_on = pay_on;
        this.total = total;
    }

    public int getId() {
        return id;
    }

    public int getUser_id() {
        return user_id;
    }

    public String getNisn() {
        return nisn;
    }

    public int getSpp_id() {
        return spp_id;
    }

    public String getPay_on() {
        return pay_on;
    }

    public int getTotal() {
        return total;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setUser_id(int user_id) {
        this.user_id = user_id;
    }

    public void setNisn(String nisn) {
        this.nisn = nisn;
    }

    public void setSpp_id(int spp_id) {
        this.spp_id = spp_id;
    }

    public void setPay_on(String pay_on) {
        this.pay_on = pay_on;
    }

    public void setTotal(int total) {
        this.total = total;
    }
    
    
}
