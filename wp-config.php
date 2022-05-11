<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'bip' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ':BUac#(6?cM15,aQTn`mA@|x5W~5WoFc;-^b.6,|y|]RA[I`c]nh fRKiltx(7sy' );
define( 'SECURE_AUTH_KEY',  'mTE5qO+TV>%ad]I$i:?e}*n|6s+TQDOIe>F4_V7yTva1~>=3C{D;R@L<oQaniCK3' );
define( 'LOGGED_IN_KEY',    'DfpF*d1Vsr}t4y&:lx=I3z9cq@>efG;_>_PTe%kC@v4=7fl%GzOfP]aOCvQqi~Tq' );
define( 'NONCE_KEY',        '5m.bk<df-4)HWcJnu8Jhozq!*S@EU<pQ_UX0UWxqwx A Bp<c*=s9^[a|s$nSTu(' );
define( 'AUTH_SALT',        '5Q}kR~XxAGKWvaN%-!Uo@oyc* iWaG(D`[+]:0@5>o9AgH!2juV1ldq2u^5C+pK(' );
define( 'SECURE_AUTH_SALT', 'F]z.%[!b-vKUuA[_%D<CS;^8n}pPA2TnHD{kutG+GO$nw=6]Br8[FuBt7<V_p&B0' );
define( 'LOGGED_IN_SALT',   'VncE,;JvZAGe?X/n(%ZL32F0O^hQP:^{MxS`!obVV}nnQ_#FC4)Dc+Q[$90=m)l[' );
define( 'NONCE_SALT',       '93|k2S;4 R}ey59BZyBps+91mW5(*dqeOpWL2PLA^?0[2pn)f)3ZzGla_ncUyg)L' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_MEMORY_LIMIT', '512M' );
/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
