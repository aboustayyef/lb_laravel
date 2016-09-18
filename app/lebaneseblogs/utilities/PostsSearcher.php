<?php 

namespace LebaneseBlogs\Utilities;

use \Post;
use Illuminate\Support\Collection;

class PostsSearcher 
{

	protected $string, $keywords, $amount, $results, $stopWords, $searchMeta;

	function __construct($string="", $amount=10)
	{

		$this->searchMeta = [];
		$this->string = $this->cleanup($string);
		$this->amount = $amount;
		$this->results = new Collection;
		$this->stopWords = new Collection(['a','about','above','after','again','against','all','am','an','and','any','are',"aren't",'as','at','be','because','been','before','being','below','between','both','but','by',"can't",'cannot','could',"couldn't",'did',"didn't",'do','does',"doesn't",'doing',"don't",'down','during','each','few','for','from','further','had',"hadn't",'has',"hasn't",'have',"haven't",'having','he',"he'd","he'll","he's",'her','here',"here's",'hers','herself','him','himself','his','how',"how's",'i',"i'd","i'll","i'm","i've",'if','in','into','is',"isn't",'it',"it's",'its','itself',"let's",'me','more','most',"mustn't",'my','myself','no','nor','not','of','off','on','once','only','or','other','ought','our','ours','ourselves','out','over','own','same',"shan't",'she',"she'd","she'll","she's",'should',"shouldn't",'so','some','such','than','that',"that's",'the','their','theirs','them','themselves','then','there',"there's",'these','they',"they'd","they'll","they're","they've",'this','those','through','to','too','under','until','up','very','was',"wasn't",'we',"we'd","we'll","we're","we've",'were',"weren't",'what',"what's",'when',"when's",'where',"where's",'which','while','who',"who's",'whom','why',"why's",'with',"won't",'would',"wouldn't",'you',"you'd","you'll","you're","you've",'your','yours','yourself','yourselves','zero', 'beirut', 'lebanon', 'lebanese']);

		// Extract keywords from strings by removing stopwords; Type: Collection;
		$this->keywords = (new Collection(explode(' ', $this->string)))->filter(function($word) { return !$this->stopWords->contains($word); });
		
		// Limit Keywords to 3;
		$this->keywords = $this->keywords->slice(0,3);

		$this->searchMeta['error'] = false;

	}

	function handle()
	{
		// If there are no keywords, it means the search is too broad. Abort.
		if (count($this->keywords) == 0) {
			$this->searchMeta['error'] = true;
			$this->searchMeta['errorMessage'] = 'The Search Term is Too broad... Please Be More Specific';
			\Session::put('searchMeta', $this->searchMeta);
			return false;
		}
		
		// Posts That have the Search String in their Title
		$postsWithStringInTitle = Post::Where('post_title','like','%'.$this->string.'%')->orderBy('post_timestamp','desc')->get()->lists('post_id');
		$this->searchMeta['exactMatchesTitle'] = count($postsWithStringInTitle);

		// Posts That have the search string in their Excerpt
		$postsWithStringInExcerpt = Post::Where('post_excerpt','like','%'.$this->string.'%')->orderBy('post_timestamp','desc')->get()->lists('post_id');
		$this->searchMeta['exactMatchesExcerpt'] = count($postsWithStringInExcerpt);

		// If there are no matches of the exact string. Leave warning message;
		if (count($postsWithStringInTitle) + count($postsWithStringInExcerpt) == 0) {
			$this->searchMeta['message'] = 'There was no exact match for "' . \Session::get('searchQuery') . '". Below are the search results for the individual keywords';
		}

		// Posts that have the individual keywords in their title
		$postsWithKeywordsInTitle = [];

		foreach ($this->keywords as $key => $keyword) {
			$posts = Post::where('post_title','like','%'.$keyword.'%')->orderBy('post_timestamp','desc')->take($this->amount)->get()->lists('post_id');
			foreach ($posts as $post) {
				$postsWithKeywordsInTitle[] = $post;
			}
			
		}

		$postsWithKeywordsInExcerpt = [];

		foreach ($this->keywords as $key => $keyword) {
			$posts = Post::where('post_excerpt','like','%'.$keyword.'%')->orderBy('post_timestamp','desc')->take($this->amount)->get()->lists('post_id');
			foreach ($posts as $post) {
				$postsWithKeywordsInExcerpt[] = $post ;
			}		
		}

		$all_posts = array_merge($postsWithStringInTitle, $postsWithStringInExcerpt, $postsWithKeywordsInTitle, $postsWithStringInExcerpt);

		$scores = [];
		foreach ($all_posts as $post) {
			$score = 0;
			if (key_exists($post, $scores)) {
				continue;
			}
			if (in_array($post, $postsWithStringInTitle)) {
				$score += 15;
			}
			if (in_array($post, $postsWithStringInExcerpt)) {
				$score += 5;
			}
			// if (in_array($post, $postsWithStringInContent)) {
			// 	$score += 4;
			// }
			if (in_array($post, $postsWithKeywordsInTitle)) {
				$score += 3;
			}
			if (in_array($post, $postsWithKeywordsInExcerpt)) {
				$score += 2;
			}
			$scores[$post] = $score;
		}

		// Not a single Result
		if (count($scores) == 0) {
			$this->searchMeta['error'] = true;
			$this->searchMeta['errorMessage'] = 'There are no results for "' . \Session::get('searchQuery') . '"' ;
			\Session::put('searchMeta', $this->searchMeta);
			return false;
		}

		// sort by value of score
		arsort($scores); 

		// group results by scores
		$groupedScores = [];
		foreach ($scores as $postId => $score) {
			$groupedScores[$score][] = $postId;
		}

		// then sort posts of same score by date
		$groupedSortedScores = [];
		foreach ($groupedScores as $batch => $ar) {
			arsort($ar);
			$groupedSortedScores[$batch] = $ar;
		}


		$this->results = new Collection;
		foreach ($groupedSortedScores as $score => $ar) {
			foreach ($ar as $key => $postId) {
				$this->results->push(Post::find($postId));
			}
		}

		\Session::put('searchMeta', $this->searchMeta);

		// Take only the amount needed
		return $this->results->slice(0, $this->amount);

	}

	private function cleanup($string){
		// replace multiple spaces with a single space and trim
		$string = trim(preg_replace("/(\s+)+/", " ", $string));
		$string = strtolower($string);

		return $string;
	}


}

?>