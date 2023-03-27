/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package view;

/**
 *
 * @author lenovo
 */
public class UserSession {
    private static String nisn;
    private static String nama;
    
    public static String get_nisn() {
        return nisn;
    } 
    public static void set_nisn(String nisn) {
        UserSession.nisn = nisn;
    }
    
    public static String get_nama() {
        return nama;
    } 
    public static void set_nama(String nama) {
        UserSession.nama = nama;
    }
}
