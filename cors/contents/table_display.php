<section>
    <div class="spinner-container">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="logout">
        <form action="cors/functions/logout.php" method="POST">
            <button type="submit" name="logout" class="game_action_button">Se déconnecter</button>
        </form>
    </div>
    <div class="content">
        <form action="index.php" method="POST" id="game-form">
            <div class="game_action">
                <button type="submit" name="create" value="create" class="create game_action_button">Ajouter une entrée</button>
                <button type="submit" name="update" value="update" class="update game_action_button">Modifier une entrée</button>
                <button value="delete" class="delete game_action_button">Supprimer une entrée</button>
            </div>
            <div class="display">
                <input type="text" placeholder="Rechercher dans ce tableau" v-model="search" class="search_in_array">
                <div class="table_head_plus_scrollbar_fixer">
                    <table class="table_full table_header">
                        <thead>
                            <tr>
                                <th class="checkbox"></th>
                                <th class="ids" @click="sort" value="ID">ID</th>
                                <th class="titles" @click="sort" value="Title"><span>Titre</span></th>
                                <th class="dates" @click="sort" value="ReleaseDate">Date de sortie</th>
                                <th class="developers" @click="sort" value="Developers">Développeur</th>
                                <th class="platforms" @click="sort" value="Platform">Console</th>
                                <th class="constructors" @click="sort" value="Constructor">Constructeur</th>
                                <th class="kinds" @click="sort" value="Kinds">Genre</th>
                                <th class="publishers" @click="sort" value="Publishers">Éditeur</th>
                                <th class="references" @click="sort" value="References">Référence</th>
                            </tr> 
                        </thead>
                    </table>
                    <div class="scrollbar_width_fixer"></div>
                </div>
                <div class="div_to_scroll undisplay">
                    <table class="table_full table_body">
                        <tbody>
                            <tr v-for="game in filtered" class="game_row">
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