class MobaHero {
    String name;
    int hp;
    int attack;

    MobaHero(String name, int hp, int attack) {
        this.name = "Miya";
        this.hp = 2225;
        this.attack = 115;
    }

    void basicAttack() {
        System.out.println(name + " menyerang dengan damage " + attack);
    }
}
