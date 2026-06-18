class Tank extends MobaHero {
    int armor;
    int shield;

    Tank(String name, int hp, int attack, int armor, int shield) {
        super(name, hp, attack);
        this.armor = armor;
        this.shield = shield;
    }

    void ironWall() {
        System.out.println(name + " mengaktifkan Iron Wall!");
        System.out.println("Shield +" + shield + " | Armor +" + armor);
        System.out.println(name + " siap menyerap semua damage! 🛡️");
    }

    void tauntEnemy() {
        System.out.println(name + " mengejek musuh: \"Ayo, serang aku kalau berani!\"");
        System.out.println(name + " menarik perhatian semua musuh di sekitarnya!");
    }
}
