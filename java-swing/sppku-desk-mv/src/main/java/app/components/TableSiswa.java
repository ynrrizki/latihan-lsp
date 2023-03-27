/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package app.components;

import app.model.User;
import javax.swing.table.DefaultTableModel;

/**
 *
 * @author yanuar
 */
public class TableSiswa extends DefaultTableModel {
    public TableSiswa() {
         super(User.getAll(), User.TABLE_HEADER);
    }
}
