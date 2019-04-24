<section>
    <form action="cors/functions/logout.php" method="POST">
        <button type="submit" name="logout">Se déconnecter</button>
    </form>
    <div class="content">
        <form action="index.php" method="POST">
        <button type="submit" name="create" value="create">Ajouter une entrée</button>
        <button type="submit" name="update" value="update">Modifier une entrée</button>
        <button type="submit" name="delete" value="delete">Supprimer une entrée</button>
        <div class="display">
            <input type="text" placeholder="Recherchez dans ce tableau" v-model="search" class="search_in_array">
            <div class="table_head_plus_scrollbar_fixer">
                <table class="table_full table_header">
                    <thead>
                        <tr>
                            <th class="checkbox"></th>
                            <th class="ids">ID</th>
                            <th class="titles"><span>Titre</span></th>
                            <th class="dates">Date de sortie</th>
                            <th class="developers">Développeur</th>
                            <th class="platforms">Console</th>
                            <th class="constructors">Constructeur</th>
                            <th class="kinds">Genre</th>
                            <th class="publishers">Éditeur</th>
                            <th class="references">Référence</th>
                        </tr> 
                    </thead>
                </table>
                <div class="scrollbar_width_fixer"></div>
            </div>
            <div class="div_to_scroll">
                <table class="table_full table_body">
                    <tbody>
                        <tr v-for="game in filtered">
                            <td><input type="checkbox" name="game[]" :value="JSON.stringify(game)" class="checkbox"></td>
                            <td class="ids">{{ game.ID }}</td>
                            <td class="titles"><span>{{ game.Title }}</span></td>
                            <td class="dates">{{ game.ReleaseDate }}</td>
                            <td class="developers">{{ game.Developers }}</td>
                            <td class="platforms">{{ game.Platform }}</td>
                            <td class="constructors">{{ game.Constructor }}</td>
                            <td class="kinds">{{ game.Kinds }}</td>
                            <td class="publishers">{{ game.Publishers }}</td>
                            <td class="references">{{ game.References }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </form>
    </div>
</section>