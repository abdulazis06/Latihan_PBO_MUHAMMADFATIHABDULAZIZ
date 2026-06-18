public class Main {
    public static void main(String[] args) {
        Tank tigreal = new Tank("Tigreal", 3200, 120, 350, 800);

        System.out.println("=== Hero Info ===");
        System.out.println("Name   : " + tigreal.name);
        System.out.println("HP     : " + tigreal.hp);
        System.out.println("Attack : " + tigreal.attack);
        System.out.println("Armor  : " + tigreal.armor);
        System.out.println("Shield : " + tigreal.shield);
        System.out.println();

        System.out.println("=== Action ===");
        tigreal.basicAttack();
        tigreal.ironWall();
        tigreal.tauntEnemy();
    }
}
