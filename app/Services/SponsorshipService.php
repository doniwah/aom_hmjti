<?php
namespace App\Services;
use App\Models\Sponsorships;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class SponsorshipService
{
    public function getData()
    {
        $sponsorships = Sponsorships::with('sponsorshipcategories')->orderby('id', 'desc')->get();
        return $sponsorships;
    }
    public function getWhere($id)
    {
        $sponsorships = Sponsorships::where('id', $id)->get();
        return $sponsorships;
    }
   public function store(Request $request)
{
    $request->validate([
        'nama_sponsor' => 'required',
        'id_sponsorship_categori' => 'required',
        'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust validation rules as needed
    ]);

    $sponsorship = new Sponsorships();
    $sponsorship->nama_sponsor = $request->nama_sponsor;
    $sponsorship->id_sponsorship_categori = $request->id_sponsorship_categori;
    $sponsorship->logo = $request->file('logo')->store('sponsor', 'public');

    if ($sponsorship->save()) {
        return response()->json(['success' => true, 'message' => 'Sponsorship saved successfully']);
    } else {
        return response()->json(['success' => false, 'message' => 'Error saving sponsorship']);
    }
}
    public function update($data, $id)
    {
        $sponsorships = Sponsorships::find($id);
        $dataupdate = [
            'nama_sponsor' => $data['nama_sponsor'],
            'id_sponsorship_categori' => $data['id_sponsorship_categori'],
        ];
        
        $existingLogo = $sponsorships->logo; 
        if (!empty($data->logo)) {
            Storage::disk('local')->delete($existingLogo); 
            $picture = uniqid() . '.' . $data->logo->extension();
            $dataupdate['logo'] = $data->file('logo')->store('sponsor','public');
        }

        $save = $sponsorships->update($dataupdate);
        if ($save) {
            return $store = '1';
        } else {
            return $store = '0';
        }
    }

    public function destroy($data)
    {
        $sponsorships = Sponsorships::findorfail($data);
        $file = $sponsorships->logo; 
        if (!empty($file)) {
            Storage::disk('local')->delete($file); 
        }
        $del = $sponsorships->delete();
        if ($del) {
            return $destroy = '1';
        } else {
            return $destroy = '0';
        }
    }
}
?>
