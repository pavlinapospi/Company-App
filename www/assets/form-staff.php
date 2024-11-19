<form  method="POST">
        <input type="text"
                name="first_name" 
                placeholder="Křestní jméno"
                value="<?= htmlspecialchars($first_name) ?>" 
                required>

        <input type="text" 
                name="second_name" 
                placeholder="Příjmení"
                value="<?= htmlspecialchars($second_name) ?>" 
                required>

        <input type="number" 
                name="age" 
                placeholder="Věk" 
                min="10" 
                value="<?= htmlspecialchars($age) ?>" 
                required>

        <input type="text" 
                name="contract" 
                placeholder="Úvazek"
                value="<?= htmlspecialchars($contract) ?>" 
                required>

        <textarea name="life" 
                        placeholder="Podrobnosti o zaměstnanci" 
                        required><?= htmlspecialchars($life) ?></textarea>
                

        <input type="submit" value="Uložit">
</form>