        EventResult::create([
            'event_id' => $event->id,
            'result_description' => 'Kegiatan berhasil membersihkan sungai dari sampah plastik dan organik. Total sampah terkumpul mencapai 150 kg.',
            'saved_waste_amount' => 150.50,
            'actual_participants' => 35,
            'result_photos' => [
                'event-results/result1.jpg',
                'event-results/result2.jpg',
                'event-results/result3.jpg'
            ],
            'result_submitted_by_name' => $admin->name,
            'result_submitted_at' => now()->subDays(5),
        ]); 